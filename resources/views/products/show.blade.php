<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Using real Laravel variable for page title -->
  <title>{{ $product->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Added custom animations and vibrant styling */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    @keyframes shimmer {
      0% { background-position: -200px 0; }
      100% { background-position: calc(200px + 100%) 0; }
    }

    .animate-fadeInUp { animation: fadeInUp 0.6s ease-out; }
    .animate-pulse-custom { animation: pulse 2s infinite; }
    .shimmer {
      background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
      background-size: 200px 100%;
      animation: shimmer 1.5s infinite;
    }

    .image-zoom {
      transition: transform 0.3s ease;
      cursor: zoom-in;
    }

    .image-zoom:hover {
      transform: scale(1.05);
    }

    /* Reduced hover scale for mobile compatibility */
    @media (max-width: 768px) {
      .image-zoom:hover {
        transform: scale(1.02);
      }
    }

    .golden-gradient {
      background: linear-gradient(135deg, #f59e0b, #d97706, #b45309);
    }

    .vibrant-shadow {
      box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
    }

    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.1);
    }

    .quantity-btn {
      transition: all 0.2s ease;
    }

    .quantity-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Added mobile-specific touch-friendly styles */
    @media (max-width: 768px) {
      .quantity-btn {
        min-height: 44px;
        min-width: 44px;
      }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-yellow-50 to-amber-50 min-h-screen font-sans">

  <!-- Simplified navigation bar to only show logo and cart -->
  <nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <!-- Logo and brand -->
        <div class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-shopping-bag text-white text-sm"></i>
          </div>
          <span class="text-xl font-bold text-gray-800">Chaka Shoping</span>
        </div>

        <!-- Cart icon with count -->
        <div class="flex items-center">
          @php
            $cartCount = 0;
            if (auth()->check()) {
                $cartCount = App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
            } else {
                $cartCount = App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
            }
          @endphp

          <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-orange-600 transition" title="View cart">
            <i class="fas fa-shopping-cart text-xl"></i>
            @if($cartCount > 0)
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
              {{ $cartCount }}
            </span>
            @endif
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Reduced floating particles for mobile performance -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none hidden md:block">
    <div class="absolute top-10 left-10 w-2 h-2 bg-yellow-300 rounded-full opacity-60 animate-bounce"></div>
    <div class="absolute top-32 right-20 w-3 h-3 bg-orange-300 rounded-full opacity-40 animate-pulse"></div>
    <div class="absolute bottom-20 left-1/4 w-2 h-2 bg-amber-300 rounded-full opacity-50 animate-bounce" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-40 right-1/3 w-1 h-1 bg-yellow-400 rounded-full opacity-70 animate-pulse" style="animation-delay: 2s;"></div>
  </div>

  <!-- Updated container padding for mobile -->
  <div class="container mx-auto px-4 sm:px-6 py-6 sm:py-12 relative z-10">
    <!-- Made breadcrumb mobile-friendly -->
    <nav class="flex items-center space-x-2 text-xs sm:text-sm text-gray-600 mb-6 sm:mb-8 animate-fadeInUp overflow-x-auto">
      <a href="/" class="hover:text-orange-600 transition-colors whitespace-nowrap">Home</a>
      <i class="fas fa-chevron-right text-xs"></i>
      <a href="/category/food-beverages" class="hover:text-orange-600 transition-colors whitespace-nowrap">Food & Beverages</a>
      <i class="fas fa-chevron-right text-xs"></i>
      <span class="text-orange-600 font-medium whitespace-nowrap">Coffee</span>
    </nav>

    <!-- Updated grid layout for better mobile stacking -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">

      <!-- Enhanced product images with zoom and interactive gallery -->
      <div class="animate-fadeInUp">
        <!-- Made image container mobile-responsive -->
        <div class="relative aspect-square w-full overflow-hidden rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl vibrant-shadow mb-4 sm:mb-6">
          <!-- Using real product image from Laravel -->
          <img id="mainImage"
               src="{{ $product->images->first()->url ?? '/placeholder.svg?height=600&width=600' }}"
               alt="{{ $product->name }}"
               class="object-cover w-full h-full image-zoom transition-all duration-500">

          <!-- Made overlay buttons mobile-friendly -->
          <div class="absolute top-2 sm:top-4 right-2 sm:right-4 flex flex-col gap-2">
            <button class="bg-white/80 backdrop-blur-sm p-2 sm:p-2 rounded-full shadow-lg hover:bg-white transition-all duration-300 group min-h-[44px] min-w-[44px] flex items-center justify-center">
              <i class="fas fa-heart text-gray-600 group-hover:text-red-500 transition-colors"></i>
            </button>
            <button class="bg-white/80 backdrop-blur-sm p-2 sm:p-2 rounded-full shadow-lg hover:bg-white transition-all duration-300 group min-h-[44px] min-w-[44px] flex items-center justify-center">
              <i class="fas fa-share-alt text-gray-600 group-hover:text-blue-500 transition-colors"></i>
            </button>
          </div>

          <!-- Using real discount percentage -->
          @if($product->discount_percent > 0)
          <!-- Made discount badge mobile-responsive -->
          <div class="absolute top-2 sm:top-4 left-2 sm:left-4">
            <span class="bg-red-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold animate-pulse-custom">
              -{{ $product->discount_percent }}% OFF
            </span>
          </div>
          @endif
        </div>

        <!-- Using real product images for thumbnail gallery -->
        @if($product->images->count() > 1)
        <!-- Made thumbnail gallery mobile-responsive -->
        <div class="flex gap-2 sm:gap-3 justify-center overflow-x-auto pb-2">
          @foreach($product->images->take(4) as $img)
          <img onclick="changeMainImage('{{ $img->url }}')"
               src="{{ $img->url }}"
               class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl object-cover border-2 border-transparent hover:border-orange-400 cursor-pointer transition-all duration-300 hover:scale-105 shadow-md flex-shrink-0">
          @endforeach
        </div>
        @endif
      </div>

      <!-- Enhanced product info with interactive elements -->
      <div class="flex flex-col justify-between animate-fadeInUp" style="animation-delay: 0.2s;">
        <div>
          <!-- Made badges mobile-responsive -->
          <div class="flex items-center gap-2 sm:gap-3 mb-4 flex-wrap">
            <span class="bg-green-100 text-green-800 px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium">
              <i class="fas fa-check-circle mr-1"></i> In Stock
            </span>
            <span class="bg-orange-100 text-orange-800 px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium">
              Premium Quality
            </span>
          </div>

          <!-- Made title mobile-responsive -->
          <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 leading-tight">
            {{ $product->name }}
          </h1>

          <!-- Made vendor info mobile-responsive -->
          <div class="text-sm sm:text-base text-gray-600 mb-4 flex flex-col sm:flex-row sm:items-center gap-2">
            <div class="flex items-center">
              <i class="fas fa-store mr-2 text-orange-500"></i>
              Sold by: <span class="font-medium text-orange-700 ml-1">{{ $product->vendor->name ?? 'Unknown Vendor' }}</span>
            </div>
            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs self-start sm:ml-3">Verified Seller</span>
          </div>

          <!-- Made rating section mobile-responsive -->
          <div class="flex flex-col sm:flex-row sm:items-center mb-6 p-3 sm:p-4 bg-white/60 backdrop-blur-sm rounded-xl sm:rounded-2xl shadow-lg gap-3 sm:gap-0">
            <div class="flex items-center">
              <div class="flex text-yellow-400 mr-3 text-base sm:text-lg">
                @for($i = 0; $i < floor($product->rating ?? 4.5); $i++)
                  <i class="fas fa-star hover:scale-110 transition-transform cursor-pointer"></i>
                @endfor
                @if(($product->rating ?? 4.5) - floor($product->rating ?? 4.5) >= 0.5)
                  <i class="fas fa-star-half-alt hover:scale-110 transition-transform cursor-pointer"></i>
                @endif
              </div>
              <span class="text-base sm:text-lg font-semibold text-gray-700">{{ $product->rating ?? '4.5' }}</span>
              <span class="text-gray-500 mx-2">•</span>
              <span class="text-sm sm:text-base text-gray-600">{{ $product->reviews_count ?? '127' }} reviews</span>
            </div>
            <button class="text-orange-600 hover:text-orange-700 font-medium text-sm hover:underline sm:ml-auto">
              Read Reviews
            </button>
          </div>

          <!-- Made pricing section mobile-responsive -->
          <div class="mb-6 sm:mb-8 p-4 sm:p-6 bg-gradient-to-r from-orange-100 to-yellow-100 rounded-xl sm:rounded-2xl shadow-lg">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-3">
              <div>
                @if($product->discount_percent > 0)
                  <p class="text-gray-500 line-through text-lg sm:text-xl">{{ number_format($product->price, 2) }} ETB</p>
                  <p class="text-3xl sm:text-4xl font-extrabold golden-gradient bg-clip-text text-transparent">
                    {{ number_format($product->price - ($product->price * $product->discount_percent / 100), 2) }} ETB
                  </p>
                @else
                  <p class="text-3xl sm:text-4xl font-extrabold golden-gradient bg-clip-text text-transparent">
                    {{ number_format($product->price, 2) }} ETB
                  </p>
                @endif
              </div>
              @if($product->discount_percent > 0)
              <div class="text-left sm:text-right">
                <span class="inline-block bg-red-500 text-white px-3 sm:px-4 py-2 rounded-full text-base sm:text-lg font-bold animate-pulse-custom">
                  -{{ $product->discount_percent }}%
                </span>
              </div>
              @endif
            </div>

            @if($product->discount_percent > 0)
            <!-- Made countdown mobile-responsive -->
            <div class="bg-red-500 text-white p-3 rounded-xl text-center">
              <p class="text-xs sm:text-sm font-medium mb-1">⚡ Flash Sale Ends In:</p>
              <div id="countdown" class="text-base sm:text-lg font-bold"></div>
            </div>
            @endif
          </div>



          <!-- Made description section mobile-responsive -->
          <div class="prose prose-sm sm:prose-lg text-gray-700 mb-6 sm:mb-8 bg-white/40 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg">
            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3">About This Product</h3>
            <div class="leading-relaxed text-sm sm:text-base">
              {!! nl2br(e($product->description)) !!}
            </div>
          </div>
        </div>

        <!-- Made cart section mobile-responsive -->
        <div class="bg-white/80 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-xl">
          <!-- Using real Laravel form action -->
          <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" class="space-y-4" novalidate>
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}" id="productId">

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <label class="text-base sm:text-lg font-semibold text-gray-800">Quantity:</label>

    <div class="flex items-center bg-gray-100 rounded-xl overflow-hidden">
      <button type="button" id="qty-decrease" class="quantity-btn px-3 sm:px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
        <i class="fas fa-minus"></i>
      </button>

      <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock ?? 10 }}"
             class="w-12 sm:w-16 text-center py-2 bg-transparent font-semibold text-base sm:text-lg focus:outline-none">

      <button type="button" id="qty-increase" class="quantity-btn px-3 sm:px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>

  <div class="space-y-3">
    <button type="submit" id="addToCartBtn"
            class="w-full py-3 sm:py-4 text-base sm:text-lg golden-gradient text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3">
      <i class="fas fa-shopping-cart text-lg sm:text-xl"></i>
      Add to Cart
      <span class="bg-white/20 px-2 py-1 rounded-full text-xs sm:text-sm" id="cartTotal">
        @php
          $unitPrice = $product->discount_percent > 0
            ? ($product->price - ($product->price * $product->discount_percent / 100))
            : $product->price;
        @endphp
        {{ number_format($unitPrice, 2) }} ETB
      </span>
    </button>
  </div>
</form>

<script>
(function(){
  const form = document.getElementById('addToCartForm');
  const qtyField = document.getElementById('quantity');
  const btn = document.getElementById('addToCartBtn');
  const totalBadge = document.getElementById('cartTotal');
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

  // base unit price (server-rendered, safe)
  const unitPrice = parseFloat('{{ number_format($unitPrice, 2, ".", "") }}');

  // recalc the price badge
  function updateTotalBadge() {
    const q = Math.max(1, parseInt(qtyField.value || '1', 10));
    const total = (unitPrice * q).toFixed(2);
    if (totalBadge) totalBadge.textContent = total + ' ETB';
  }

  // plus/minus handlers
  document.getElementById('qty-decrease').addEventListener('click', ()=>{
    qtyField.value = Math.max(parseInt(qtyField.min || '1',10), (parseInt(qtyField.value||'1',10) - 1));
    updateTotalBadge();
  });
  document.getElementById('qty-increase').addEventListener('click', ()=>{
    qtyField.value = Math.min(parseInt(qtyField.max || '9999',10), (parseInt(qtyField.value||'1',10) + 1));
    updateTotalBadge();
  });
  qtyField.addEventListener('change', updateTotalBadge);

  // AJAX submit with graceful fallback
  form.addEventListener('submit', async function(e){
    e.preventDefault();

    // disable button
    btn.disabled = true;
    const oldHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

    // build payload
    const fd = new FormData(form);

    try {
      const resp = await fetch("{{ route('cart.add') }}", {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: fd
      });

      // If server returns JSON (recommended), parse it
      const json = await resp.json().catch(()=> null);

      if (!resp.ok) {
        // show friendly error (server may return JSON error.message)
        const msg = (json && (json.message || json.error)) || 'Could not add to cart. Try again.';
        alert(msg);
        btn.disabled = false;
        btn.innerHTML = oldHTML;
        return;
      }

      // success
      // update UI: optimistic badge + small animation
      btn.innerHTML = '<i class="fas fa-check"></i> Added';
      setTimeout(()=> { btn.innerHTML = oldHTML; btn.disabled = false; }, 1200);

      // Dispatch global event to update cart badge elsewhere (header script listens for 'cart:updated')
      window.dispatchEvent(new Event('cart:updated'));

      // Optionally redirect to cart page — comment out if you don't want redirect
      // window.location.href = "{{ route('cart.index') }}";

    } catch (err) {
      // network error -> fallback to normal submit (let browser handle)
      console.error(err);
      alert('Network error — submitting form normally.');
      form.removeEventListener('submit', arguments.callee); // remove handler
      form.submit();
    }
  });

  // initial badge calc
  updateTotalBadge();
})();
</script>

        </div>
      </div>
    </div>



    <!-- Added vibrant, animated related products section -->
    @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <section class="mt-12 sm:mt-16 animate-fadeInUp" style="animation-delay: 0.6s;">
      <div class="text-center mb-8 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">You Might Also Like</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-orange-400 to-yellow-400 mx-auto rounded-full"></div>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach($relatedProducts as $rp)
          @php
            $img = optional($rp->images->first())->path ? Storage::url($rp->images->first()->path) : '/placeholder.svg?height=300&width=300';
            $discount = $rp->discount_percent ?? 0;
            $final = $discount > 0 ? ($rp->price - ($rp->price * ($discount/100))) : $rp->price;
            $vendorName = $rp->vendor->business_name ?? ($rp->vendor->user->name ?? 'Vendor');
          @endphp

          <div class="group bg-white/60 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 border border-white/20">
            <!-- Product Image with Overlay -->
            <div class="relative overflow-hidden">
              <a href="{{ route('products.show', $rp->id) }}" class="block">
                <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden">
                  <img src="{{ $img }}"
                       alt="{{ $rp->name }}"
                       class="w-full h-full object-cover transform transition-all duration-700 group-hover:scale-110 group-hover:rotate-2">
                </div>
              </a>

              <!-- Discount Badge -->
              @if($discount > 0)
              <div class="absolute top-2 left-2">
                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold animate-pulse">
                  -{{ $discount }}%
                </span>
              </div>
              @endif

              <!-- Quick Actions Overlay -->
              <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                <div class="flex gap-2">
                  <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg hover:bg-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-heart text-gray-600 hover:text-red-500"></i>
                  </button>
                  <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg hover:bg-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-eye text-gray-600 hover:text-blue-500"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Product Info -->
            <div class="p-3 sm:p-4">
              <a href="{{ route('products.show', $rp->id) }}" class="block group-hover:text-orange-600 transition-colors">
                <h4 class="font-semibold text-gray-800 text-sm sm:text-base leading-tight mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                  {{ \Illuminate\Support\Str::limit($rp->name, 50) }}
                </h4>
              </a>

              <!-- Vendor Info -->
              <div class="flex items-center text-xs text-gray-500 mb-3">
                <i class="fas fa-store mr-1"></i>
                <span class="truncate">{{ \Illuminate\Support\Str::limit($vendorName, 20) }}</span>
              </div>

              <!-- Rating -->
              <div class="flex items-center mb-3">
                <div class="flex text-yellow-400 text-xs mr-2">
                  @for($i = 0; $i < 5; $i++)
                    <i class="fas fa-star"></i>
                  @endfor
                </div>
                <span class="text-xs text-gray-500">(4.5)</span>
              </div>

              <!-- Price and Add to Cart -->
              <div class="flex items-center justify-between">
                <div class="flex-1">
                  @if($discount > 0)
                    <div class="text-xs text-gray-400 line-through">{{ number_format($rp->price, 0) }} ETB</div>
                    <div class="text-sm sm:text-base font-bold golden-gradient bg-clip-text text-transparent">
                      {{ number_format($final, 0) }} ETB
                    </div>
                  @else
                    <div class="text-sm sm:text-base font-bold golden-gradient bg-clip-text text-transparent">
                      {{ number_format($rp->price, 0) }} ETB
                    </div>
                  @endif
                </div>

                <!-- Enhanced Add to Cart Button -->
                <form action="{{ route('cart.add') }}" method="POST" class="ml-2">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $rp->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit"
                          class="group/btn relative overflow-hidden bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white p-2 sm:p-2.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 min-w-[40px] min-h-[40px] flex items-center justify-center"
                          title="Add to cart">
                    <i class="fas fa-shopping-cart text-sm relative z-10 group-hover/btn:scale-110 transition-transform"></i>
                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform duration-300 origin-left"></div>
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- View All Products Button -->
      <div class="text-center mt-8 sm:mt-12">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-orange-400 to-yellow-400 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
          <span class="text-sm sm:text-base">View All Products</span>
          <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
    </section>
    @endif
  </div>

  <!-- Updated JavaScript to work with real Laravel data -->
  <script>
    // Store product data from Laravel
    const productData = {
      price: {{ $product->discount_percent > 0 ? $product->price - ($product->price * $product->discount_percent / 100) : $product->price }},
      originalPrice: {{ $product->price }},
      discountPercent: {{ $product->discount_percent ?? 0 }}
    };

    // Image gallery functionality
    function changeMainImage(src) {
      document.getElementById('mainImage').src = src;

      // Add smooth transition effect
      const img = document.getElementById('mainImage');
      img.style.opacity = '0.7';
      setTimeout(() => {
        img.style.opacity = '1';
      }, 150);
    }

    // Quantity controls
    function increaseQuantity() {
      const qty = document.getElementById('quantity');
      if (parseInt(qty.value) < 10) {
        qty.value = parseInt(qty.value) + 1;
        updateCartTotal();
      }
    }

    function decreaseQuantity() {
      const qty = document.getElementById('quantity');
      if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
        updateCartTotal();
      }
    }

    // Update cart total with real price
    function updateCartTotal() {
      const quantity = parseInt(document.getElementById('quantity').value);
      const total = (quantity * productData.price).toFixed(2);
      document.getElementById('cartTotal').textContent = total + ' ETB';
    }

    // Enhanced add to cart with Laravel form submission
    function addToCart(event) {
      event.preventDefault();
      const form = document.getElementById('addToCartForm');
      const button = event.target;
      const originalText = button.innerHTML;

      // Show loading state
      button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
      button.disabled = true;

      // Submit form via AJAX
      fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          button.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
          button.classList.add('bg-green-500');
        } else {
          button.innerHTML = '<i class="fas fa-exclamation"></i> Error!';
          button.classList.add('bg-red-500');
        }

        // Reset after 2 seconds
        setTimeout(() => {
          button.innerHTML = originalText;
          button.disabled = false;
          button.classList.remove('bg-green-500', 'bg-red-500');
        }, 2000);
      })
      .catch(error => {
        console.error('Error:', error);
        button.innerHTML = originalText;
        button.disabled = false;
      });
    }

    // Countdown timer
    function startCountdown() {
      const endTime = new Date().getTime() + (2 * 24 * 60 * 60 * 1000); // 2 days from now

      const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('countdown').innerHTML =
          `${days}d ${hours}h ${minutes}m ${seconds}s`;

        if (distance < 0) {
          clearInterval(timer);
          document.getElementById('countdown').innerHTML = "EXPIRED";
        }
      }, 1000);
    }

    // Initialize with real product data
    document.addEventListener('DOMContentLoaded', function() {
      @if($product->discount_percent > 0)
      startCountdown();
      @endif
      updateCartTotal();

      // Add scroll animations
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);

      // Observe all animated elements
      document.querySelectorAll('.animate-fadeInUp').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
      });
    });
  </script>
</body>
</html>
