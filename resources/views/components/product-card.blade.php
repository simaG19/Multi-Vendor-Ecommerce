@props(['product'])

<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative">
            @if(!empty($product->discount_percent) && $product->discount_percent > 0)
                <div class="absolute top-2 left-2 z-10">
                    <span class="bg-orange-500 text-white px-2 py-1 rounded text-sm font-medium">-{{ $product->discount_percent }}%</span>
                </div>
            @endif

            <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                @php
                    // pick first available image from the three columns
                    $imgPath = $product->img_1 ?? $product->img_2 ?? $product->img_3 ?? null;
                    $imgUrl = $imgPath ? \Illuminate\Support\Facades\Storage::url($imgPath) : null;
                    $placeholder = '/placeholder.svg?height=200&width=200';
                @endphp

                @if($imgUrl)
                    <img src="{{ $imgUrl }}"
                         alt="{{ $product->name }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <img src="{{ $placeholder }}"
                         alt="No image for {{ $product->name }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @endif
            </div>
        </div>

        <div class="p-4">
            <h3 class="font-medium text-gray-800 mb-2 line-clamp-2">{{ $product->name }}</h3>

            @if(!empty($product->brand))
                <p class="text-sm text-gray-500 mb-2">{{ $product->brand }}</p>
            @endif

            <div class="flex items-center space-x-2 mb-2">
                @if(!empty($product->discount_percent) && $product->discount_percent > 0)
                    @php
                        $discountedPrice = $product->price * (1 - $product->discount_percent / 100);
                    @endphp
                    <span class="text-gray-400 line-through text-sm">{{ number_format($product->price, 2) }} ETB</span>
                    <span class="text-orange-500 font-bold text-lg">{{ number_format($discountedPrice, 2) }} ETB</span>
                @else
                    <span class="text-orange-500 font-bold text-lg">{{ number_format($product->price, 2) }} ETB</span>
                @endif
            </div>

            @php
                // safer vendor resolution
                if ($product->vendor) {
                    $vendorName = $product->vendor->business_name
                        ?? $product->vendor->name
                        ?? ($product->vendor->user->name ?? 'Vendor');
                } else {
                    $vendorName = 'Vendor';
                }
            @endphp

            @if($vendorName)
                <p class="text-xs text-gray-400">by {{ $vendorName }}</p>
            @endif
        </div>
    </a>
</div>
