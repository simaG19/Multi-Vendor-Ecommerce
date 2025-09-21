@php $editing = isset($product); @endphp

<div class="grid grid-cols-1 gap-4">
    {{-- No vendor dropdown here, admin products are created under admin only --}}

    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full border rounded px-3 py-2">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">SKU</label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Brand</label>
            <input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium">Price</label>
            <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Discount %</label>
            <input type="number" name="discount_percent" min="0" max="100" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
            <option value="">-- none --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium">Images (1-5)</label>
        <input type="file" name="images[]" multiple accept="image/*" class="w-full">
        <p class="text-xs text-gray-500 mt-1">Uploading new images will append to existing images.</p>

        @if($editing && $product->images->count())
            <div class="mt-3 flex gap-2 flex-wrap">
                @foreach($product->images as $img)
                    <div class="w-20 h-20 rounded overflow-hidden border relative">
                        <img src="{{ Storage::url($img->path) }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
            <span class="text-sm">Active</span>
        </label>
    </div>
</div>
