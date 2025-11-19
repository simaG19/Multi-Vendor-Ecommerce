<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $vendor;

    public function __construct()
    {
        // make sure user is authenticated; route group also applies role:vendor
        // $this->middleware('auth');
        $this->vendor = null;
    }

    /**
 * Remove the specified product (and its images) from storage.
 */
public function destroy(Product $product)
{
    $vendor = $this->getVendor();
    if (! $vendor) {
        abort(403, 'Vendor profile not found.');
    }

    // ensure the logged-in vendor owns this product
    if ($product->vendor_id !== $vendor->id) {
        abort(403, 'You do not own this product.');
    }

    DB::transaction(function () use ($product) {
        // delete image files and records
        foreach ($product->images as $img) {
            try {
                if ($img->path && Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
            } catch (\Throwable $e) {
                \Log::warning("Failed deleting image file for product {$product->id}: ".$e->getMessage());
            }

            // remove DB record
            $img->delete();
        }

        // delete the product record
        $product->delete();
    });

    return redirect()->route('vendor.products.index')->with('success', 'Product deleted.');
}


    protected function getVendor()
    {
        if ($this->vendor) return $this->vendor;
        $this->vendor = Auth::user()->vendor ?? null;
        return $this->vendor;
    }

    public function index()
    {
        $vendor = $this->getVendor();
        if (! $vendor) {
            return redirect()->route('vendor.dashboard')->with('error', 'Vendor profile not found.');
        }

        $products = $vendor->products()->with('images')->latest()->paginate(15);
        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $vendor = $this->getVendor();
        if (! $vendor) return redirect()->route('vendor.dashboard')->with('error','Vendor profile not found.');

        $categories = Category::orderBy('name')->get();

        return view('vendor.products.create', compact('vendor','categories'));
    }

    public function show(Product $product)
    {
        $vendor = $this->getVendor();
        if (! $vendor) abort(403, 'Vendor profile not found.');

        if ($product->vendor_id !== $vendor->id) {
            abort(403, 'You do not own this product.');
        }

        return view('vendor.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $vendor = $this->getVendor();
        if (! $vendor) abort(403, 'Vendor profile not found.');

        if ($product->vendor_id !== $vendor->id) {
            abort(403, 'You do not own this product.');
        }

        $categories = Category::orderBy('name')->get();

        return view('vendor.products.edit', compact('product','categories','vendor'));
    }

    public function store(StoreUpdateProductRequest $request)
{
    $vendor = $this->getVendor();
    if (! $vendor) {
        return redirect()
            ->route('vendor.products.index')
            ->with('error', 'Vendor profile not found.');
    }

    // Get validated data
    $data = $request->validated();
    $data['vendor_id'] = $vendor->id;

    // Remove any file inputs from data so create() doesn't try to mass-assign uploaded files
    $data = Arr::except($data, ['img_1', 'img_2', 'img_3']);

    DB::beginTransaction();
    try {
        // create product
        $product = Product::create($data);

        // store each image if uploaded and set path on the product
        foreach (['img_1', 'img_2', 'img_3'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // store on public disk under products/
                $path = $file->store('products', 'public');
                $product->{$field} = $path;
            }
        }

        // save if any image was set
        if ($product->isDirty(['img_1', 'img_2', 'img_3'])) {
            $product->save();
        }

        DB::commit();
    } catch (\Throwable $e) {
        DB::rollBack();
        // optionally log: \Log::error($e);
        return redirect()->back()->with('error', 'Could not create product.')->withInput();
    }

    return redirect()
        ->route('vendor.products.index')
        ->with('success', 'Product created.');
}

public function update(StoreUpdateProductRequest $request, Product $product)
{
    $vendor = $this->getVendor();
    if (! $vendor) abort(403, 'Vendor profile not found.');
    if ($product->vendor_id !== $vendor->id) abort(403, 'You do not own this product.');

    $data = $request->validated();
    $data['vendor_id'] = $vendor->id;

    // Remove file inputs so we don't try to mass assign them
    $updateData = Arr::except($data, ['img_1', 'img_2', 'img_3']);

    DB::beginTransaction();
    try {
        $product->update($updateData);

        // For each image field: if a new file uploaded, delete old and store new
        foreach (['img_1', 'img_2', 'img_3'] as $field) {
            if ($request->hasFile($field)) {
                // delete old file if exists
                if ($product->{$field}) {
                    Storage::disk('public')->delete($product->{$field});
                }

                $file = $request->file($field);
                $path = $file->store('products', 'public');
                $product->{$field} = $path;
            }
        }

        // persist any image changes
        if ($product->isDirty(['img_1', 'img_2', 'img_3'])) {
            $product->save();
        }

        DB::commit();
    } catch (\Throwable $e) {
        DB::rollBack();
        // optionally log: \Log::error($e);
        return redirect()->back()->with('error', 'Could not update product.')->withInput();
    }

    return redirect()->route('vendor.products.index')->with('success','Product updated.');
}

    /**
     * Delete a product image (and the file on disk).
     * Route: DELETE vendor/products/{product}/images/{image}
     */
    public function destroyImage(Product $product, ProductImage $image)
    {
        $vendor = $this->getVendor();
        if (! $vendor) abort(403, 'Vendor profile not found.');

        if ($product->vendor_id !== $vendor->id || $image->product_id !== $product->id) {
            abort(403, 'Unauthorized.');
        }

        // safe delete: remove file from disk and DB record
        try {
            if ($image->path && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            $image->delete();

            // optionally reindex positions (compact positions)
            $remaining = $product->images()->orderBy('position')->get();
            $pos = 0;
            foreach ($remaining as $rem) {
                $rem->position = $pos++;
                $rem->save();
            }

            return back()->with('success', 'Image deleted.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not delete image.');
        }
    }

    /**
     * Store uploaded images for a product.
     * @param Product $product
     * @param array $files array of UploadedFile instances
     */


protected function storeImagesForProduct(Product $product, array $files)
{
    foreach ($files as $file) {
        if (! $file->isValid()) {
            \Log::warning('Skipped invalid upload file for product '.$product->id);
            continue;
        }

        $ext = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = Str::random(16) . '.' . $ext;
        $folder = "products/{$product->id}";

        // NOTE: third argument should be the disk name string 'public'
        $path = $file->storeAs($folder, $filename, 'public');

        if (! $path) {
            \Log::error("Failed to store uploaded file for product {$product->id}");
            continue;
        }

        // compute next position
        $position = $product->images()->max('position');
        $position = is_null($position) ? 0 : $position + 1;

        // create DB record
        ProductImage::create([
            'product_id' => $product->id,
            'path'       => $path,
            'filename'   => $file->getClientOriginalName(),
            'position'   => $position,
        ]);

        \Log::info("Stored product image", ['product' => $product->id, 'path' => $path]);
    }
}

}
