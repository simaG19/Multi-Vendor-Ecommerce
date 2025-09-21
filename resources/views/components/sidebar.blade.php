@props(['categories', 'vendors', 'brands'])

<div class="bg-white rounded-lg shadow-md p-4">
    <!-- Categories Filter -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-800 mb-3">Categories</h3>
        <div class="space-y-2">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category_id' => $category->id]) }}"
                   class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors {{ request('category_id') == $category->id ? 'bg-orange-50 border-l-4 border-orange-500' : '' }}">
                    <div class="w-6 h-6 bg-orange-100 rounded flex items-center justify-center">
                        <i class="fas fa-tag text-orange-500 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Vendors Filter -->
    @if($vendors->count() > 0)
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">Vendors</h3>
            <div class="space-y-2 max-h-48 overflow-y-auto">
                @foreach($vendors as $vendor)
                    <a href="{{ route('products.index', ['vendor_id' => $vendor->id]) }}"
                       class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded cursor-pointer transition-colors {{ request('vendor_id') == $vendor->id ? 'bg-orange-50' : '' }}">
                        <span class="text-sm text-gray-700">{{ $vendor->business_name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Brands Filter -->
    @if($brands->count() > 0)
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">Brands</h3>
            <div class="space-y-2 max-h-48 overflow-y-auto">
                @foreach($brands as $brand)
                    <a href="{{ route('products.index', ['brand' => $brand]) }}"
                       class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded cursor-pointer transition-colors {{ request('brand') == $brand ? 'bg-orange-50' : '' }}">
                        <span class="text-sm text-gray-700">{{ $brand }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Price Range Filter -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-800 mb-3">Price Range</h3>
        <form action="{{ route('products.index') }}" method="GET" class="space-y-3">
            <!-- Preserve existing filters -->
            @foreach(request()->except(['price_min', 'price_max', 'page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="flex space-x-2">
                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600 transition-colors text-sm">
                Apply
            </button>
        </form>
    </div>

    <!-- Sale Filter -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-800 mb-3">Special Offers</h3>
        <a href="{{ route('products.index', array_merge(request()->all(), ['on_sale' => '1'])) }}"
           class="flex items-center space-x-2 p-2 hover:bg-gray-50 rounded cursor-pointer transition-colors {{ request('on_sale') == '1' ? 'bg-orange-50' : '' }}">
            <i class="fas fa-fire text-orange-500"></i>
            <span class="text-sm text-gray-700">On Sale</span>
        </a>
    </div>
</div>
