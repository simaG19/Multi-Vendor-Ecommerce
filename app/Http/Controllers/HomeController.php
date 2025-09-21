<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category; // <-- new
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // <-- new


class HomeController extends Controller
{
    public function index(Request $request)
    {
        // slides: prioritized discounted products (fallback to recent)
        $slides = Product::with('images')
            ->where('is_active', true)
            ->where('discount_percent', '>', 0)
            ->latest()
            ->limit(6)
            ->get();

        if ($slides->isEmpty()) {
            $slides = Product::with('images')->where('is_active', true)->latest()->limit(6)->get();
        }

        // main products grid (latest active)
        $products = Product::with('images','category','vendor')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        // vendors: approved vendors with product counts (for home page)
        $vendors = Vendor::withCount('products')
            ->with(['user', 'products' => function($q) {
                $q->with('images')->latest()->limit(1);
            }])
            ->when(Schema::hasColumn('vendors', 'is_approved'), function($q) {
                // only apply where if column exists
                $q->where('is_approved', true);
            })
            ->orderByDesc('products_count')
            ->limit(8)
            ->get();

        // categories: only attempt to load if the table exists
        if (Schema::hasTable('categories')) {
            // if you use an "is_active" column, adjust accordingly
            if (Schema::hasColumn('categories', 'is_active')) {
                $categories = Category::where('is_active', true)->orderBy('name')->get();
            } else {
                $categories = Category::orderBy('name')->get();
            }
        } else {
            $categories = collect(); // empty collection fallback
        }

    $featured = Product::with(['images','vendor','category'])
    ->where('is_active', true)
    ->where('discount_percent', '>', 0)
    ->orderByDesc('discount_percent') // big discounts first
    ->latest()
    ->limit(8)
    ->get();

    // Get discounted products (no flash sale timer, just listing)
$discountedProducts = Product::with(['images', 'vendor', 'category'])
    ->where('is_active', true)
    ->where('discount_percent', '>', 0)
    ->orderByDesc('discount_percent')
    ->latest()
    ->limit(8)
    ->get();

// if none found, fallback to latest active products
if ($featured->isEmpty()) {
    $featured = Product::with(['images','vendor','category'])
        ->where('is_active', true)
        ->latest()
        ->limit(8)
        ->get();
}
// recommended: paginated listing for "all products"
$allProducts = Product::with(['images','vendor','category'])
    ->where('is_active', true)
    ->latest()
    ->paginate(20); // change per-page as you like


return view('home', compact('slides','products','vendors','categories', 'discountedProducts','featured','allProducts'));
    }
}
