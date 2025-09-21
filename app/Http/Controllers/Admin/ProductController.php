<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{

    public function destroyImage(Product $product, $imageId)
{
    $img = $product->images()->where('id',$imageId)->firstOrFail();
    // remove file
    if ($img->path && Storage::disk('public')->exists($img->path)) {
        Storage::disk('public')->delete($img->path);
    }
    $img->delete();
    return back()->with('success','Image removed.');
}

    public function index(Request $request)
    {
        $q = Product::with(['vendor','category'])->latest();

        if ($request->filled('search')) {
            $q->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $q->paginate(20)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $vendors = Vendor::orderBy('business_name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('vendors','categories'));
    }


public function store(StoreProductRequest $request)
{
    $data = $request->validated();

    // mark admin creator
    $data['created_by'] = auth()->id();

    // If current user is admin, ensure vendor_id is null (admin-owned product)
    $user = auth()->user();
    $isAdmin = (isset($user->role) && strtolower($user->role) === 'admin') || (isset($user->is_admin) && $user->is_admin);
    if ($isAdmin) {
        $data['vendor_id'] = null;
    }

    $data['is_active'] = $request->has('is_active') ? boolval($request->is_active) : true;

    $product = Product::create($data);

    if ($request->hasFile('images')) {
        $this->storeImagesForProduct($product, $request->file('images'));
    }

    return redirect()->route('admin.products.index')->with('success', 'Product created.');
}


public function update(StoreProductRequest $request, Product $product)
{
    $data = $request->validated();
    $data['is_active'] = $request->has('is_active') ? boolval($request->is_active) : false;

    // record admin who last updated / edited the product (optional)
    $data['created_by'] = Auth::id();

    $product->update($data);

    if ($request->hasFile('images')) {
        $this->storeImagesForProduct($product, $request->file('images'));
    }

    return redirect()->route('admin.products.index')->with('success','Product updated.');
}


    public function edit(Product $product)
    {
        $product->load('images');
        $vendors = Vendor::orderBy('business_name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product','vendors','categories'));
    }

    // public function update(StoreProductRequest $request, Product $product)
    // {
    //     $data = $request->validated();
    //     $data['is_active'] = $request->has('is_active') ? boolval($request->is_active) : false;
    //     $product->update($data);

    //     // If new images uploaded, append them (do not replace existing unless admin expects it)
    //     if ($request->hasFile('images')) {
    //         $this->storeImagesForProduct($product, $request->file('images'));
    //     }

    //     return redirect()->route('admin.products.index')->with('success','Product updated.');
    // }

    public function destroy(Product $product)
    {
        // delete will trigger product model booted() to remove images from disk if implemented
        $product->delete();
        return back()->with('success','Product deleted.');
    }

    /**
     * Store uploaded images for a product (can be reused elsewhere).
     * $files is an array of UploadedFile instances.
     */
    protected function storeImagesForProduct(Product $product, array $files)
    {
        foreach ($files as $file) {
            if (! $file->isValid()) continue;

            $filename = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $folder = "products/{$product->id}";
            $path = $file->storeAs($folder, $filename, 'public');

            // compute next position
            $position = $product->images()->max('position');
            $position = is_null($position) ? 0 : $position + 1;

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
                'position' => $position,
            ]);
        }
    }
}
