@props(['product'])

<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
    {{-- route: pass model or id (works with route-model-binding or id-based route) --}}
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative">
            @if(!empty($product->discount_percent) && $product->discount_percent > 0)
                <div class="absolute top-2 left-2 z-10">
                    <span class="bg-orange-500 text-white px-2 py-1 rounded text-sm font-medium">-{{ $product->discount_percent }}%</span>
                </div>
            @endif

            <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                @php
                    // try common attributes in order: accessor 'url' or 'getUrlAttribute', 'path', 'image_path'
                    $imgModel = optional($product->images->first());
                    $imgPath = $imgModel->path ?? $imgModel->image_path ?? null;
                    $imgUrl = $imgPath ? \Illuminate\Support\Facades\Storage::url($imgPath) : null;
                @endphp

                @if($imgUrl)
                    <img src="{{ $imgUrl }}"
                         alt="{{ $product->name }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <img src="/placeholder.svg?height=200&width=200"
                         alt="{{ $product->name }}"
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

            @if($product->vendor)
                <p class="text-xs text-gray-400">by {{ $product->vendor->business_name ?? $product->vendor->user->name ?? 'Vendor' }}</p>
            @endif
        </div>
    </a>
</div>
