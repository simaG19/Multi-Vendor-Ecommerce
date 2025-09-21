<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class PublicVendorController extends Controller
{
    /**
     * Show vendor profile (public).
     */
    public function show(Vendor $vendor)
    {
        // eager load a few things we may show (user, first products)
        $vendor->load(['user']);

        // Example: show latest 8 products on vendor page
        $products = $vendor->products()->with('images', 'category')->where('is_active', true)->latest()->take(8)->get();

        return view('vendor.show', compact('vendor', 'products'));
    }

    /**
     * List vendor products (public listing, paginated).
     */
    public function products(Vendor $vendor, Request $request)
    {
        $query = $vendor->products()->with('images','category')->where('is_active', true);

        // optional filters from query
        if ($q = $request->input('q')) {
            $query->where('name', 'like', "%{$q}%");
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('vendor.products.index', compact('vendor','products'));
    }
}
