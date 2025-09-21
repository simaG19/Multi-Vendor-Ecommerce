@php
    $editing = isset($product);
@endphp

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Product Images (1-5)</label>
    <input type="file" name="images[]" multiple accept="image/*" class="form-control">
    <small class="form-text text-muted">You can upload up to 5 images per product. Each max 5MB.</small>
</div>


<div class="mb-3">
    <label class="form-label">SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control">
</div>

<label>Brand</label>
<input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}">

<label>Discount (%)</label>
<input type="number" name="discount_percent" min="0" max="100" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}">

<label>Category</label>
<select name="category_id">
    <option value="">-- Select Category --</option>
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}"
            @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
            {{ $cat->name }}
        </option>
    @endforeach
</select>


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
