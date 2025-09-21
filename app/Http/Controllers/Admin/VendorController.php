<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

use App\Http\Requests\AdminVendorUpdateRequest;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;


class VendorController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'pending'); // pending|approved|all
        $query = Vendor::query()->with('user');

        if ($filter === 'pending') {
            $query->where('is_approved', false)->where('status', 'pending');
        } elseif ($filter === 'approved') {
            $query->where('is_approved', true)->where('status', 'approved');
        }

        $vendors = $query->latest()->paginate(20)->withQueryString();

        return view('admin.vendors.index', compact('vendors', 'filter'));
    }

public function show(Vendor $vendor)
{
    $vendor->load('user');

    // Orders that include any product from this vendor
    $vendorOrders = \App\Models\Order::whereHas('items.product', function ($q) use ($vendor) {
        $q->where('vendor_id', $vendor->id);
    })
    ->with(['user','items.product']) // eager load
    ->latest()
    ->paginate(15);

    return view('admin.vendors.show', compact('vendor','vendorOrders'));
}





public function destroy(Request $request, Vendor $vendor)
{
    // Very important: confirm admin intent (optional): you could require admin password re-entry here.
    // For now we proceed, but we run inside a DB transaction so partial deletes won't leave inconsistent state.
    DB::transaction(function () use ($vendor) {

        // 1) Delete product images files and ProductImage rows
        $products = $vendor->products()->with('images')->get();
        foreach ($products as $product) {
            foreach ($product->images as $img) {
                if ($img->path && Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
                // delete DB record (ProductImage model)
                $img->delete();
            }
            // delete product record (this will also drop any product-related rows if you have cascade)
            $product->delete();
        }

        // 2) Delete vendor record
        // If your Vendor model uses SoftDeletes and you prefer soft-deleting, call $vendor->delete()
        // (which will soft-delete). The code below performs a hard delete.
        $user = $vendor->user; // keep reference to owner user

        $vendor->delete();

        // 3) Demote owner user or optionally delete the user
        if ($user) {
            // SAFER DEFAULT: demote role (don't delete user)
            if (property_exists($user, 'role')) {
                $user->role = 'user'; // or null, or 'customer', adjust to your app
                $user->save();
            }

            // If you *really* want to delete the user, uncomment:
            // $user->delete();
        }
    });

    return redirect()->route('admin.vendors.index')->with('success', 'Vendor and related products deleted.');
}


public function approve(Request $request, Vendor $vendor)
{
    DB::transaction(function () use ($vendor) {
        $vendor->is_approved = true;
        $vendor->status = 'approved';
        // optional: record when approved
        if (Schema::hasColumn('vendors', 'approved_at')) {
            $vendor->approved_at = Carbon::now();
        }
        $vendor->save();

        // set owner user role to vendor if applicable
        if ($vendor->user) {
            // adjust to your app's role system
            if (property_exists($vendor->user, 'role')) {
                $vendor->user->role = 'vendor';
                $vendor->user->save();
            }
        }
    });

    return redirect()->route('admin.vendors.show', $vendor)->with('success', 'Vendor approved.');
}
    public function reject(Request $request, Vendor $vendor)
    {
        $vendor->is_approved = false;
        $vendor->status = 'rejected';
        $vendor->save();

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor rejected/suspended.');
    }



       public function edit(Vendor $vendor)
    {
        $vendor->load('user');
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(AdminVendorUpdateRequest $request, Vendor $vendor)
    {
        $data = $request->validated();

        // normalize checkbox
        $data['is_approved'] = $request->has('is_approved') ? (bool) $request->input('is_approved') : $vendor->is_approved;

        // set status/approved_at if approval toggled
        if ($data['is_approved'] && !$vendor->is_approved) {
            $data['status'] = $data['status'] ?? 'approved';
            $data['approved_at'] = Carbon::now();
        } elseif (! $data['is_approved']) {
            $data['status'] = $data['status'] ?? 'rejected';
        }

        $vendor->fill($data);
        $vendor->save();

        // optionally sync user role if approving
        if ($vendor->is_approved && $vendor->user) {
            $roleProp = property_exists($vendor->user, 'role') ? 'role' : null;
            if ($roleProp) {
                $vendor->user->role = 'vendor'; // adjust if you use constants
                $vendor->user->save();
            }
        }

        return redirect()->route('admin.vendors.show', $vendor)->with('success', 'Vendor updated.');
    }
}
