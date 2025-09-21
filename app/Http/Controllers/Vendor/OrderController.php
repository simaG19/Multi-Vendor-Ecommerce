<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

    // use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // List all orders that include products from this vendor
    public function index(Request $request)
    {
        $vendor = Auth::user()->vendor;
        if (! $vendor) abort(403, 'Vendor profile not found.');

        $orders = Order::whereHas('items.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })
        ->with(['user', 'items.product.vendor']) // eager load
        ->latest()
        ->paginate(15);

        return view('vendor.orders.index', compact('orders'));
    }


    public function updateStatus(Request $request, Order $order)
{
    $vendor = Auth::user()->vendor;
    if (! $vendor) abort(403, 'Vendor profile not found.');

    // Ensure vendor belongs to this order
    $has = $order->items()->whereHas('product', function ($q) use ($vendor) {
        $q->where('vendor_id', $vendor->id);
    })->exists();

    if (! $has) abort(403, 'Order does not contain your products.');

    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
    ]);

    // ✅ Update order table instead of order_items
    $order->update(['status' => $request->status]);

    return redirect()
        ->route('vendor.orders.show', $order)
        ->with('success', 'Order status updated.');
}


    // redirect to /order/{order_number}
    public function checkRedirect(Request $request)
    {
        $request->validate(['order_number' => 'required|string']);
        return redirect()->route('order.public.show', $request->order_number);
    }

    // public show by order number
    public function publicShow($order_number)
    {
        $order = Order::with('items.product.images')->where('order_number', $order_number)->firstOrFail();

        // only show minimal sensitive fields to public viewers (no internal notes)
        return view('order.public_show', compact('order'));
    }

    // Show a single order — vendor only sees their items inside the order
    public function show(Order $order)
    {
        $vendor = Auth::user()->vendor;
        if (! $vendor) abort(403, 'Vendor profile not found.');

        // Ensure order contains at least one item for this vendor
        $has = $order->items()->whereHas('product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->exists();

        if (! $has) abort(403, 'Order does not contain your products.');

        // Load only the vendor's items for display and product relationships
        $vendorItems = $order->items()->whereHas('product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->with('product')->get();

        // Still pass overall order info (user, totals etc.)
        $order->load('user');

        return view('vendor.orders.show', compact('order','vendorItems'));
    }




// public function updateStatus(Request $request, Order $order)
// {
//     $vendor = Auth::user()->vendor;
//     if (! $vendor) {
//         abort(403, 'Vendor profile not found.');
//     }

//     // ensure this order contains items for this vendor
//     $has = $order->items()->whereHas('product', function ($q) use ($vendor) {
//         $q->where('vendor_id', $vendor->id);
//     })->exists();

//     if (! $has) {
//         abort(403, 'Order does not contain your products.');
//     }

//     $data = $request->validate([
//         'status' => ['required','string','in:pending,processing,shipped,delivered,cancelled'],
//     ]);

//     $newStatus = $data['status'];

//     DB::transaction(function() use ($order, $vendor, $newStatus) {
//         // Update only the order_items that belong to this vendor
//         $affected = OrderItem::where('order_id', $order->id)
//             ->whereHas('product', function($q) use ($vendor) {
//                 $q->where('vendor_id', $vendor->id);
//             })
//             ->update(['status' => $newStatus]);

//         // Optionally: if all order items (across vendors) now have the same status,
//         // set the overall order status to that value.
//         $distinct = OrderItem::where('order_id', $order->id)->distinct()->pluck('status')->filter()->values();

//         if ($distinct->count() === 1) {
//             $order->status = $distinct->first();
//             $order->save();
//         } else {
//             // otherwise leave the main order status as-is (or set to 'processing' etc.)
//             // $order->status = 'processing'; $order->save();
//         }

//         // You may want to fire events/notifications here, e.g. notify customer/vendor.
//     });

//     return redirect()->back()->with('success', 'Order status updated for your items.');
// }

}
