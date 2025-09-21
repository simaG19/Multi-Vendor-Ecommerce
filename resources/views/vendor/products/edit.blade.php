@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 <form action="{{ route('vendor.products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

<input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

        {{-- EXISTING IMAGES --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Existing Images</label>
            <div class="flex flex-wrap gap-3">
                @forelse($product->images as $img)
                    <div class="w-28 h-28 border rounded overflow-hidden relative">
                        <img src="{{ \Storage::url($img->path) }}" alt="" class="w-full h-full object-cover">
                        <form action="{{ route('vendor.products.images.destroy', [$product, $img]) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this image?')"
                              class="absolute top-1 right-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white rounded-full w-6 h-6 text-xs leading-6">×</button>
                        </form>
                    </div>
                @empty
                    <div class="text-gray-500">No images yet.</div>
                @endforelse
            </div>
            <p class="text-sm text-gray-500 mt-2">You can upload up to <strong>5</strong> images per product.</p>
        </div>

        {{-- ADD IMAGES --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Add Images (append)</label>
            <input type="file" name="images[]" id="imagesInput" multiple accept="image/*" class="block w-full border px-3 py-2 rounded">
            <p class="text-sm text-gray-500 mt-1">Max total images: 5. Each image max 5MB.</p>
        </div>

        {{-- BASIC FIELDS --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium mb-1">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block font-medium mb-1">Price (ETB)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Discount %</label>
                <input type="number" name="discount_percent" min="0" max="100" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" rows="5" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex items-center gap-4 mb-6">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" class="form-checkbox" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <span class="text-sm">Active</span>
            </label>
            <div class="text-sm text-gray-500">Total images: <span id="existingCount">{{ $product->images->count() }}</span>/5</div>
        </div>

        <div class="flex gap-3">
           <input type="submit" value="Update Product" class="btn btn-primary">

 <a href="{{ route('vendor.products.index') }}" class="px-4 py-2 border rounded text-gray-700">Cancel</a>
        </div>
    </form>
</div>

<script>
(function(){
    const existingCountEl = document.getElementById('existingCount');
    const existingCount = parseInt(existingCountEl?.textContent || '0', 10);
    const imagesInput = document.getElementById('imagesInput');
    const form = document.getElementById('productForm');

    function totalSelected() {
        return imagesInput.files ? imagesInput.files.length : 0;
    }

    imagesInput?.addEventListener('change', function(){
        const selected = totalSelected();
        if (existingCount + selected > 5) {
            alert('You can upload a maximum of 5 images per product. Remove some files or delete existing images first.');
            imagesInput.value = ''; // clear
        }
    });

    // final check before submit
    form?.addEventListener('submit', function(e){
        const selected = totalSelected();
        if (existingCount + selected > 5) {
            e.preventDefault();
            alert('Too many images. Please ensure total images for this product is at most 5.');
            return false;
        }
    });
})();
</script>
@endsection
