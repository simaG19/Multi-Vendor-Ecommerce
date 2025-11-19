@php
    $editing = isset($product);
    $placeholder = '/placeholder.svg?height=300&width=300';
@endphp

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Product Images (3 required)</label>

    <div class="grid grid-cols-3 gap-3">
        {{-- Image slot 1 --}}
        <div class="text-center">
            <div class="w-full h-40 bg-gray-50 rounded overflow-hidden mb-2 flex items-center justify-center">
                <img id="preview_img_1" src="{{ $editing && $product->img_1 ? Storage::url($product->img_1) : $placeholder }}" alt="Image 1" class="w-full h-full object-cover">
            </div>
            <input type="file" name="img_1" id="img_1" accept="image/*" class="form-control" {{ $editing ? '' : 'required' }}>
            <p class="text-xs text-gray-500 mt-1">Primary image (shown in listings)</p>
        </div>

        {{-- Image slot 2 --}}
        <div class="text-center">
            <div class="w-full h-40 bg-gray-50 rounded overflow-hidden mb-2 flex items-center justify-center">
                <img id="preview_img_2" src="{{ $editing && $product->img_2 ? Storage::url($product->img_2) : $placeholder }}" alt="Image 2" class="w-full h-full object-cover">
            </div>
            <input type="file" name="img_2" id="img_2" accept="image/*" class="form-control" {{ $editing ? '' : 'required' }}>
            <p class="text-xs text-gray-500 mt-1">Secondary image</p>
        </div>

        {{-- Image slot 3 --}}
        <div class="text-center">
            <div class="w-full h-40 bg-gray-50 rounded overflow-hidden mb-2 flex items-center justify-center">
                <img id="preview_img_3" src="{{ $editing && $product->img_3 ? Storage::url($product->img_3) : $placeholder }}" alt="Image 3" class="w-full h-full object-cover">
            </div>
            <input type="file" name="img_3" id="img_3" accept="image/*" class="form-control" {{ $editing ? '' : 'required' }}>
            <p class="text-xs text-gray-500 mt-1">Third image</p>
        </div>
    </div>

    <p class="text-xs text-gray-500 mt-2">
        Upload one image per slot. On edit, uploading a file for a slot will replace that slot's existing image.
        Max size recommended: 5MB per image.
    </p>
</div>

<div class="mb-3">
    <label class="form-label">SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Brand</label>
    <input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Discount (%)</label>
    <input type="number" name="discount_percent" min="0" max="100" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-control">
        <option value="">-- Select Category --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Active</label>
</div>

{{-- JS image preview (vanilla) --}}
<script>
    (function(){
        function preview(inputId, imgId) {
            const fileInput = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!fileInput || !img) return;
            fileInput.addEventListener('change', function () {
                const f = this.files && this.files[0];
                if (!f) return;
                const url = URL.createObjectURL(f);
                img.src = url;
            }, { passive: true });
        }

        preview('img_1', 'preview_img_1');
        preview('img_2', 'preview_img_2');
        preview('img_3', 'preview_img_3');
    })();
</script>
