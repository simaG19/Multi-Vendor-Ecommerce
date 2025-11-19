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

    {{-- IMAGE SLOTS: img_1, img_2, img_3 --}}
    <div class="mb-6">
        <label class="block font-semibold mb-2">Product Images (3 slots)</label>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @php
                $slots = [
                    ['field' => 'img_1', 'label' => 'Image 1'],
                    ['field' => 'img_2', 'label' => 'Image 2'],
                    ['field' => 'img_3', 'label' => 'Image 3'],
                ];
                $placeholder = '/placeholder.svg?height=200&width=200';
            @endphp

            @foreach($slots as $slot)
                @php
                    $field = $slot['field'];
                    $currentPath = $product->{$field} ?? null;
                    $currentUrl = $currentPath ? Storage::url($currentPath) : null;
                @endphp

                <div class="space-y-2">
                    <label class="text-sm font-medium">{{ $slot['label'] }}</label>

                    <div class="w-full h-36 border rounded overflow-hidden relative bg-gray-100 flex items-center justify-center">
                        @if($currentUrl)
                            <img id="{{ $field }}Preview" src="{{ $currentUrl }}" alt="" class="w-full h-full object-cover">
                        @else
                            <img id="{{ $field }}Preview" src="{{ $placeholder }}" alt="" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="block w-full">
                            <span class="sr-only">Upload {{ $slot['label'] }}</span>
                            <input
                                type="file"
                                name="{{ $field }}"
                                id="{{ $field }}Input"
                                accept="image/*"
                                class="block w-full text-sm text-gray-700"
                            >
                        </label>

                        {{-- remove checkbox (sends remove_img_X=1 when checked) --}}
                        <label class="inline-flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remove_{{ $field }}" id="remove_{{ $field }}" class="form-checkbox h-4 w-4">
                            <span>Remove</span>
                        </label>
                    </div>

                    <p class="text-xs text-gray-500">Uploading a file will <strong>replace</strong> the current image for this slot. Checking <strong>Remove</strong> will delete the existing image for this slot on update.</p>
                </div>
            @endforeach
        </div>

        <p class="text-sm text-gray-500 mt-3">Slots filled after edit: <span id="existingCount">0</span>/3</p>
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
    </div>

    <div class="flex gap-3">
        <input type="submit" value="Update Product" class="btn btn-primary">
        <a href="{{ route('vendor.products.index') }}" class="px-4 py-2 border rounded text-gray-700">Cancel</a>
    </div>
</form>

</div>
{{-- JS: preview selected file and update slots count live --}}
<script>
    (function () {
        const slots = ['img_1','img_2','img_3'];
        const placeholder = '{{ $placeholder }}';

        function hasExisting(field) {
            // blade rendered previews point to either placeholder or real url; treat placeholder as "no existing"
            const img = document.getElementById(field + 'Preview');
            return img && img.src && !img.src.includes('placeholder.svg');
        }

        function updateCount() {
            let count = 0;
            slots.forEach(field => {
                const removeCheckbox = document.getElementById('remove_' + field);
                const fileInput = document.getElementById(field + 'Input');
                const willBeRemoved = removeCheckbox && removeCheckbox.checked;
                const fileSelected = fileInput && fileInput.files && fileInput.files.length > 0;
                const existing = hasExisting(field);

                if ((existing && !willBeRemoved) || fileSelected) {
                    count++;
                }
            });
            document.getElementById('existingCount').textContent = count;
        }

        // preview file when selected and update count
        slots.forEach(field => {
            const input = document.getElementById(field + 'Input');
            const removeCheckbox = document.getElementById('remove_' + field);

            if (input) {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    const preview = document.getElementById(field + 'Preview');
                    if (file && preview) {
                        const reader = new FileReader();
                        reader.onload = function (ev) {
                            preview.src = ev.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else if (preview) {
                        // if no file chosen, optionally show placeholder or existing again (do nothing)
                    }
                    // if a file is chosen, uncheck remove checkbox
                    if (file && removeCheckbox) removeCheckbox.checked = false;
                    updateCount();
                });
            }

            if (removeCheckbox) {
                removeCheckbox.addEventListener('change', () => {
                    // if remove checked, clear file input preview & value
                    if (removeCheckbox.checked) {
                        const preview = document.getElementById(field + 'Preview');
                        const input = document.getElementById(field + 'Input');
                        if (input) input.value = '';
                        if (preview) preview.src = placeholder;
                    } else {
                        // if unchecked, we won't restore original preview here (page reload retains original); user can re-upload
                    }
                    updateCount();
                });
            }
        });

        // init counter on load
        updateCount();
    })();
</script>


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
