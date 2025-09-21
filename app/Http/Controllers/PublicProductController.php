<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;



class PublicProductController extends Controller
{
    public function index(Request $request)
    {
        // dropdown lists
        $categories = Category::orderBy('name')->get();
        $vendors = Vendor::where('is_approved', true)->orderBy('business_name')->get();
        $brands = Product::select('brand')
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        // base query
        $q = Product::with('images','category','vendor')->where('is_active', true);

        // search (name + description + sku)
        if ($search = $request->input('q')) {
            $q->where(function ($sub) use ($search) {
                $searchTerm = '%' . str_replace('%','\\%',$search) . '%';
                $sub->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('sku', 'like', $searchTerm);
            });
        }

        // vendor filter
        if ($vendorId = $request->input('vendor_id')) {
            $q->where('vendor_id', $vendorId);
        }

        // category filter
        if ($categoryId = $request->input('category_id')) {
            $q->where('category_id', $categoryId);
        }

        // brand filter
        if ($brand = $request->input('brand')) {
            $q->where('brand', $brand);
        }

        // discount filter: on_sale = 1 => discount_percent > 0
        if ($request->input('on_sale') == '1') {
            $q->where('discount_percent', '>', 0);
        }

        // price range filter (apply to final price or base price? we filter by base price here)
        $min = $request->input('price_min');
        $max = $request->input('price_max');
        if (is_numeric($min)) {
            $q->where('price', '>=', (float)$min);
        }
        if (is_numeric($max)) {
            $q->where('price', '<=', (float)$max);
        }

        // sorting (optional)
        $sort = $request->input('sort', 'latest'); // latest | price_asc | price_desc
        match($sort) {
            'price_asc' => $q->orderBy('price','asc'),
            'price_desc' => $q->orderBy('price','desc'),
            default => $q->latest()
        };

        // discounted highlight list for hero strip
        $discounted = Product::with('images')->where('is_active', true)->where('discount_percent', '>', 0)->limit(8)->get();

        // paginate results, keep query params
        $products = $q->paginate(12)->withQueryString();

        return view('products.index', compact('products','categories','vendors','brands','discounted'));
    }






public function show($id)
{
    // load product with relations
    $product = Product::with(['images','vendor','category'])->findOrFail($id);

    // Build related products query:
    // - prefer same category, then same brand, then same vendor
    // - exclude current product
    // - only active products
    $query = Product::with(['images','vendor'])
        ->where('is_active', true)
        ->where('id', '!=', $product->id);

    // Collect OR conditions if available
    $query->where(function($q) use ($product) {
        $added = false;
        if ($product->category_id) {
            $q->orWhere('category_id', $product->category_id);
            $added = true;
        }
        if (!empty($product->brand)) {
            $q->orWhere('brand', $product->brand);
            $added = true;
        }
        // always include same vendor as lower-priority fallback
        $q->orWhere('vendor_id', $product->vendor_id);
    });

    // Optionally prioritize category matches over brand/vendor using a raw score (works in MySQL)
    // note: uses boolean comparisons that evaluate to 1/0
    $scoreBindings = [
        $product->category_id ?? 0,
        $product->brand ?? '',
        $product->vendor_id ?? 0,
    ];

    $query->orderByRaw("
        (category_id = ?) DESC,
        (brand = ?) DESC,
        (vendor_id = ?) DESC
    ", $scoreBindings);

    // randomize within the same score and limit to 8
    $relatedProducts = $query->inRandomOrder()->limit(8)->get();

    return view('products.show', compact('product','relatedProducts'));
}


}
