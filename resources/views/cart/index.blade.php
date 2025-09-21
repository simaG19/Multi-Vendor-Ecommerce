{{-- resources/views/cart/custom_index.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Your Cart</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* small custom tweaks */
    .card-shadow { box-shadow: 0 10px 30px rgba(2,6,23,0.06); }
    .btn-ghost { background: transparent; border: 1px solid rgba(15,23,42,0.06); }
    .fade-in { animation: fadeIn .36s ease both; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px) } to { opacity: 1; transform: none } }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
  <div class="max-w-6xl mx-auto px-4 py-10">

    <header class="flex items-center justify-between mb-8">
      <div class="flex items-center gap-3">
        <div class="bg-gradient-to-tr from-orange-400 to-amber-400 text-white rounded-xl w-12 h-12 flex items-center justify-center text-2xl shadow-md">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold">Your Cart</h1>
          <p class="text-sm text-gray-500">Review items, adjust quantities, then checkout.</p>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white card-shadow hover:shadow-lg transition">
          <i class="fas fa-arrow-left text-gray-600"></i>
          <span class="text-sm font-medium">Continue shopping</span>
        </a>
      </div>
    </header>

    {{-- Flash messages --}}
    @if(session('success'))
      <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-800 border border-green-100">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-800 border border-red-100">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      {{-- Cart items (left, spans 2 columns) --}}
      <div class="lg:col-span-2 space-y-6">
        @if($carts->isEmpty())
          <div class="p-8 bg-white rounded-2xl card-shadow text-center fade-in">
            <h2 class="text-xl font-semibold mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-4">Find great products in our catalog.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-amber-400 hover:bg-amber-500 text-white px-5 py-2 rounded-lg">Shop now</a>
          </div>
        @else
          @foreach($carts as $c)
            @php
              $prod = $c->product;
              $img = optional($prod->images->first())->path ? Storage::url($prod->images->first()->path) : 'https://via.placeholder.com/160x160?text=No+image';
              $price = $c->price ?? $prod->price ?? 0;
              $subtotal = $price * $c->quantity;
              $vendor = $prod->vendor->business_name ?? ($prod->vendor->user->name ?? 'Vendor');
            @endphp

            <article class="bg-white rounded-2xl p-6 flex flex-col md:flex-row items-start md:items-center gap-6 card-shadow fade-in" data-cart-id="{{ $c->id }}">
              <img src="{{ $img }}" alt="{{ $prod->name }}" class="w-28 h-28 object-cover rounded-lg shadow-sm flex-shrink-0">

              <div class="flex-1 min-w-0">
                <a href="{{ route('products.show', $prod) }}" class="block">
                  <h3 class="text-lg font-semibold truncate">{{ $prod->name }}</h3>
                </a>
                <p class="text-sm text-gray-500 mt-1">By <span class="font-medium text-gray-700">{{ $vendor }}</span></p>
                <div class="mt-3 flex items-center gap-4">
                  <div class="text-2xl font-bold text-orange-600">{{ number_format($price,2) }} ETB</div>
                  <div class="text-sm text-gray-400">Unit price</div>
                </div>
              </div>

              {{-- Quantity controls & actions --}}
              <div class="w-full md:w-auto flex flex-col items-stretch gap-3">
                {{-- Qty form (works without JS) --}}
                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2 qty-form" data-cart-id="{{ $c->id }}">
                  @csrf
                  <input type="hidden" name="cart_id" value="{{ $c->id }}">

                  <button type="button" class="px-3 py-2 rounded-full bg-gray-100 hover:bg-gray-200 transition btn-decrease" aria-label="Decrease">
                    <i class="fas fa-minus text-sm text-gray-700"></i>
                  </button>

                  <input name="quantity" type="number" min="1" value="{{ $c->quantity }}" class="w-16 text-center rounded-lg border border-gray-200 py-2">

                  <button type="button" class="px-3 py-2 rounded-full bg-gray-100 hover:bg-gray-200 transition btn-increase" aria-label="Increase">
                    <i class="fas fa-plus text-sm text-gray-700"></i>
                  </button>

                  <button type="submit" class="hidden md:inline-block ml-2 bg-amber-400 hover:bg-amber-500 text-white px-3 py-2 rounded-lg">Update</button>
                </form>

                <div class="text-right">
                  <div class="text-sm text-gray-500">Subtotal</div>
                  <div class="text-lg font-semibold">{{ number_format($subtotal,2) }} ETB</div>
                </div>

                <div class="flex gap-2">
                  <form action="{{ route('cart.remove') }}" method="POST" class="flex-1 remove-form">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $c->id }}">
                    <button type="submit" class="w-full text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">Remove</button>
                  </form>
                </div>
              </div>
            </article>
          @endforeach
        @endif
      </div>

      {{-- Summary + Checkout (right) --}}
      <aside class="space-y-6">
        <div class="bg-white rounded-2xl p-6 card-shadow">
          <h4 class="text-lg font-semibold mb-4">Order Summary</h4>
          <div class="flex justify-between text-sm text-gray-500 mb-2">
            <div>Items</div>
            <div>{{ $carts->sum('quantity') }}</div>
          </div>

          <div class="flex justify-between items-center mb-4">
            <div class="text-sm text-gray-500">Subtotal</div>
            <div class="text-xl font-bold">{{ number_format($total ?? $carts->sum(function($ci){ return ($ci->price ?? ($ci->product->price ?? 0)) * $ci->quantity; }), 2) }} ETB</div>
          </div>

          <div class="border-t border-dashed border-gray-200 pt-4">
            <button id="open-checkout" class="w-full bg-amber-400 hover:bg-amber-500 text-white py-3 rounded-lg font-semibold">Checkout</button>
          </div>
        </div>

        {{-- Mini help card --}}
        <div class="bg-white rounded-2xl p-6 card-shadow">
          <h5 class="font-semibold mb-2">Need help?</h5>
          <p class="text-sm text-gray-500">Contact support or call <span class="font-medium">+251 900 000000</span></p>
          <a href="#" class="mt-3 inline-block text-amber-500 hover:underline">Contact support</a>
        </div>
      </aside>
    </div>

    {{-- Checkout modal (hidden by default) --}}
    <div id="checkout-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
      <div class="bg-white rounded-2xl w-full max-w-3xl mx-4 md:mx-0 overflow-hidden card-shadow">
        <div class="flex items-center justify-between p-6 border-b">
          <h3 class="text-xl font-semibold">Checkout — Payment Proof</h3>
          <button id="close-checkout" class="text-gray-500 hover:text-gray-700"><i class="fas fa-times text-lg"></i></button>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium mb-1">Phone number</label>
              <input name="phone" required class="w-full rounded-lg border border-gray-200 p-3" placeholder="+251 9XXXXXXXX">
            </div>

            <div>
              <label class="block text-sm font-medium mb-1">Shipping address</label>
              <textarea name="shipping_address" required class="w-full rounded-lg border border-gray-200 p-3 h-28" placeholder="Full address, city, region..."></textarea>
            </div>

            <div>
              <label class="block text-sm font-medium mb-1">Payment screenshot</label>
              <input id="payment-input" type="file" name="payment_screenshot" accept="image/*" required>
              <p class="text-xs text-gray-400 mt-2">Upload a screenshot of the payment transaction (max 5MB).</p>
            </div>

            <div id="preview-wrap" class="hidden">
              <label class="block text-sm font-medium mb-1">Preview</label>
              <img id="preview-img" src="" alt="preview" class="w-full h-36 object-contain rounded border border-gray-200">
            </div>

            <div class="flex justify-end gap-3 pt-2">
              <button type="button" id="cancel-checkout" class="px-4 py-2 rounded-lg btn-ghost">Cancel</button>
              <button type="submit" class="px-4 py-2 rounded-lg bg-amber-400 hover:bg-amber-500 text-white">Place order</button>
            </div>
          </form>

          {{-- Simple order summary inside modal --}}
          <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold mb-3">Order summary</h4>
            <ul class="space-y-2 text-sm text-gray-700">
              @foreach($carts as $c)
                <li class="flex justify-between">
                  <span class="truncate pr-2">{{ \Illuminate\Support\Str::limit($c->product->name ?? '—', 40) }}</span>
                  <span>{{ number_format(($c->price ?? $c->product->price ?? 0) * $c->quantity,2) }} ETB</span>
                </li>
              @endforeach
            </ul>
            <div class="border-t mt-4 pt-3 flex justify-between items-center">
              <div class="text-sm text-gray-500">Total</div>
              <div class="text-lg font-bold">{{ number_format($total ?? $carts->sum(function($ci){ return ($ci->price ?? ($ci->product->price ?? 0)) * $ci->quantity; }), 2) }} ETB</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<script>
(function(){
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Helpers
  async function postJSON(url, formData) {
    const resp = await fetch(url, {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
      body: formData
    });
    const json = await resp.json().catch(()=> null);
    if (!resp.ok) throw json || { message: 'Request failed' };
    return json;
  }

  // Quantity +/- behavior (delegated)
  document.addEventListener('click', async (e) => {
    const dec = e.target.closest('.btn-decrease');
    const inc = e.target.closest('.btn-increase');
    if (!dec && !inc) return;
    const form = (dec || inc).closest('form');
    const input = form.querySelector('input[name="quantity"]');
    let val = parseInt(input.value || '1', 10);
    val = dec ? Math.max(1, val - 1) : Math.max(1, val + 1);
    input.value = val;

    // Auto-submit via AJAX for snappy UX
    try {
      const fd = new FormData(form);
      await postJSON(form.action, fd);
      // refresh cart to show server-accurate totals (simple reliable approach)
      window.location.reload();
    } catch (err) {
      console.warn('Qty update failed', err);
      // fallback to normal submit (do nothing)
    }
  });

  // intercept qty forms for explicit "Update" clicks
  document.querySelectorAll('.qty-form').forEach(form => {
    form.addEventListener('submit', async function(e){
      e.preventDefault();
      try {
        const fd = new FormData(form);
        await postJSON(form.action, fd);
        window.location.reload();
      } catch (err) {
        alert(err?.message || 'Could not update quantity.');
      }
    });
  });

  // intercept removes
  document.querySelectorAll('.remove-form').forEach(form => {
    form.addEventListener('submit', async function(e){
      e.preventDefault();
      if (!confirm('Remove this item?')) return;
      try {
        const fd = new FormData(form);
        await postJSON(form.action, fd);
        window.location.reload();
      } catch (err) {
        alert(err?.message || 'Could not remove item.');
      }
    });
  });

  // Checkout modal controls
  const modal = document.getElementById('checkout-modal');
  const openBtn = document.getElementById('open-checkout');
  const closeBtn = document.getElementById('close-checkout');
  const cancelBtn = document.getElementById('cancel-checkout');

  openBtn?.addEventListener('click', ()=> modal.classList.remove('hidden'));
  closeBtn?.addEventListener('click', ()=> modal.classList.add('hidden'));
  cancelBtn?.addEventListener('click', ()=> modal.classList.add('hidden'));

  // payment preview
  const paymentInput = document.getElementById('payment-input');
  const previewWrap = document.getElementById('preview-wrap');
  const previewImg = document.getElementById('preview-img');
  if (paymentInput) {
    paymentInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (!file) { previewWrap.classList.add('hidden'); previewImg.src = ''; return; }
      const url = URL.createObjectURL(file);
      previewImg.src = url;
      previewWrap.classList.remove('hidden');
    });
  }

  // close modal on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') modal.classList.add('hidden');
  });

})();
</script>

<!-- fontawesome (icons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>
