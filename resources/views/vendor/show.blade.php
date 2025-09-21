<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nana')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Enhanced styling with better colors and animations -->
    <style>
        .mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.show {
            transform: translateY(0);
        }

        /* Enhanced gradient and shadow effects */
        .nav-gradient {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Enhanced header with gradient background and better styling -->
    <header class="bg-white shadow-lg border-b sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Enhanced logo with gradient background -->
                <div class="flex items-center">
                    <div class="nav-gradient text-white p-2 rounded-lg mr-3 shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Nana</span>
                </div>

                 <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-golden-500 to-golden-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-sm"></i>
                        </div>

                    </div>
                  @php
  // fallback to empty collections if not provided by controller
  $vendors = $vendors ?? collect();
  $categories = $categories ?? collect();
@endphp

                    <!-- Desktop Navigation - unchanged -->
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ url('/home') }}" class="text-gray-700 hover:text-golden-600 transition">Home</a>
                        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-golden-600 transition">Products</a>

                        <!-- Vendors dropdown (hover + click) -->
                        <div class="relative group" x-data>
                            <button
                                type="button"
                                class="text-gray-700 hover:text-golden-600 transition flex items-center gap-2"
                                data-dropdown-btn="vendors"
                                aria-expanded="false"
                            >
                                Vendors
                                <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clipRule="evenodd"/>
                                </svg>
                            </button>

                            <!-- Panel: appears on hover (group-hover) OR when JS toggles data-open -->
                            <div
                                class="origin-top-left absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg ring-1 ring-black/5 opacity-0 scale-95 transform transition-all duration-150 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto"
                                data-dropdown="vendors"
                            >
                                <div class="p-3">
                                    <div class="text-xs text-gray-400 uppercase font-medium mb-2">Top vendors</div>

                                    <div class="grid gap-2">
                                        @forelse($vendors->take(8) as $v)
                                            <a href="{{ url('/vendor/'.$v->id) }}" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50 transition">
                                                <img src="{{ optional($v->logo)->path ? Storage::url($v->logo->path) : 'https://via.placeholder.com/48' }}"
                                                     alt="{{ $v->business_name ?? 'Vendor' }}"
                                                     class="w-8 h-8 rounded-full object-cover">
                                                <div class="truncate">
                                                    <div class="text-sm text-gray-800 truncate">{{ $v->business_name ?? ($v->user->name ?? 'Vendor') }}</div>
                                                    <div class="text-xs text-gray-500 truncate">{{ $v->city ?? '' }}</div>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="text-sm text-gray-500 p-2">No vendors yet.</div>
                                        @endforelse
                                    </div>

                                    <div class="mt-3 border-t pt-3">
                                        <a href="{{ url('/vendors') }}" class="text-sm text-golden-600 hover:underline">View all vendors →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories dropdown (hover + click) -->
                        <div class="relative group">
                            <button
                                type="button"
                                class="text-gray-700 hover:text-golden-600 transition flex items-center gap-2"
                                data-dropdown-btn="categories"
                                aria-expanded="false"
                            >
                                Categories
                                <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clipRule="evenodd"/>
                                </svg>
                            </button>

                            <div
                                class="origin-top-left absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black/5 opacity-0 scale-95 transform transition-all duration-150 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto"
                                data-dropdown="categories"
                            >
                                <div class="p-3">
                                    <div class="text-xs text-gray-400 uppercase font-medium mb-2">Browse categories</div>
                                    <div class="grid grid-cols-1 gap-2">
                                        @forelse($categories->take(10) as $cat)
                                            <a href="{{ url('/products?category='.$cat->id) }}" class="block p-2 rounded hover:bg-gray-50 transition text-sm text-gray-700">
                                                {{ $cat->name }}
                                            </a>
                                        @empty
                                            <div class="text-sm text-gray-500 p-2">No categories.</div>
                                        @endforelse
                                    </div>
                                    <div class="mt-3 border-t pt-3">
                                        <a href="{{ url('/categories') }}" class="text-sm text-golden-600 hover:underline">View all categories →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/order/check" class="text-gray-700 hover:text-golden-600 transition">My order</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Enhanced search bar with better styling -->
                    <div class="relative hidden sm:block">
                        <input
                            type="text"
                            placeholder="Search products..."
                            class="w-52 pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 bg-gray-50 focus:bg-white"
                        >
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>

                   @php
    // compute cart count for current user or guest session
    use App\Models\Cart;
    $cartCount = 0;
    if (auth()->check()) {
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
    } else {
        $cartCount = Cart::where('session_id', session()->getId())->sum('quantity');
    }
@endphp

                    <!-- Enhanced cart icon with better styling -->
                    <a href="{{ route('cart.index') }}" class="relative p-2.5 text-gray-700 hover:text-orange-500 transition-all duration-300 hover:bg-orange-50 rounded-lg" title="View cart">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span id="cart-badge" class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-md">
                            {{ $cartCount ?: '' }}
                        </span>
                    </a>

                    <!-- Enhanced login button -->
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-orange-500 transition-all duration-300 hover:bg-orange-50 rounded-lg">
                        <i class="fas fa-sign-in-alt text-lg"></i>
                        <span class="hidden md:inline ml-2 font-medium">Login</span>
                    </a>

                    <!-- Mobile menu button -->
                    <button
                        id="mobile-menu-btn"
                        class="md:hidden p-2 text-gray-700 hover:text-golden-600 transition"
                        aria-label="Toggle mobile menu"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Mobile Search -->
                    <div class="px-3 py-2">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Search products..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-transparent"
                            >
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Mobile Navigation Links -->
                    <a href="{{ url('/') }}" class="block px-3 py-2 text-gray-700 hover:text-golden-600 hover:bg-gray-50 rounded-md transition">Home</a>
                    <a href="{{ route('products.index') }}" class="block px-3 py-2 text-gray-700 hover:text-golden-600 hover:bg-gray-50 rounded-md transition">Products</a>

                    <!-- Mobile Vendors Dropdown -->
                    <div class="px-3 py-2">
                        <button
                            class="w-full flex items-center justify-between text-gray-700 hover:text-golden-600 transition"
                            data-mobile-dropdown="vendors"
                        >
                            <span>Vendors</span>
                            <svg class="w-4 h-4 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clipRule="evenodd"/>
                            </svg>
                        </button>
                        <div class="hidden mt-2 pl-4 space-y-1" data-mobile-dropdown-content="vendors">
                            @forelse($vendors->take(8) as $v)
                                <a href="{{ url('/vendor/'.$v->id) }}" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50 transition">
                                    <img src="{{ optional($v->logo)->path ? Storage::url($v->logo->path) : 'https://via.placeholder.com/32' }}"
                                         alt="{{ $v->business_name ?? 'Vendor' }}"
                                         class="w-6 h-6 rounded-full object-cover">
                                    <div class="truncate">
                                        <div class="text-sm text-gray-800 truncate">{{ $v->business_name ?? ($v->user->name ?? 'Vendor') }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $v->city ?? '' }}</div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-sm text-gray-500 p-2">No vendors yet.</div>
                            @endforelse
                            <a href="{{ url('/vendors') }}" class="block text-sm text-golden-600 hover:underline p-2">View all vendors →</a>
                        </div>
                    </div>

                    <!-- Mobile Categories Dropdown -->
                    <div class="px-3 py-2">
                        <button
                            class="w-full flex items-center justify-between text-gray-700 hover:text-golden-600 transition"
                            data-mobile-dropdown="categories"
                        >
                            <span>Categories</span>
                            <svg class="w-4 h-4 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fillRule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clipRule="evenodd"/>
                            </svg>
                        </button>
                        <div class="hidden mt-2 pl-4 space-y-1" data-mobile-dropdown-content="categories">
                            @forelse($categories->take(10) as $cat)
                                <a href="{{ url('/products?category='.$cat->id) }}" class="block p-2 rounded hover:bg-gray-50 transition text-sm text-gray-700">
                                    {{ $cat->name }}
                                </a>
                            @empty
                                <div class="text-sm text-gray-500 p-2">No categories.</div>
                            @endforelse
                            <a href="{{ url('/categories') }}" class="block text-sm text-golden-600 hover:underline p-2">View all categories →</a>
                        </div>
                    </div>

                    <a href="/order/check" class="block px-3 py-2 text-gray-700 hover:text-golden-600 hover:bg-gray-50 rounded-md transition">My order</a>
                </div>
            </div>
        </div>
    </nav>

<!-- Updated JavaScript to handle both desktop and mobile dropdowns -->
<script>
  (function(){
    // Helper: find panel by name
    function panelFor(name){ return document.querySelector('[data-dropdown="'+name+'"]'); }
    function btnFor(name){ return document.querySelector('[data-dropdown-btn="'+name+'"]'); }

    // Toggle a dropdown panel (open/close)
    function toggle(name, open){
      const panel = panelFor(name);
      const btn = btnFor(name);
      if (!panel || !btn) return;
      open = (typeof open === 'boolean') ? open : !panel.classList.contains('open');
      if (open){
        panel.classList.add('open');
        panel.style.opacity = '1';
        panel.style.transform = 'translateY(0) scale(1)';
        panel.style.pointerEvents = 'auto';
        btn.setAttribute('aria-expanded', 'true');
      } else {
        panel.classList.remove('open');
        panel.style.opacity = '';
        panel.style.transform = '';
        panel.style.pointerEvents = '';
        btn.setAttribute('aria-expanded', 'false');
      }
    }

    // Close all dropdowns
    function closeAll(){
      document.querySelectorAll('[data-dropdown]').forEach(p => {
        p.classList.remove('open');
        p.style.opacity = '';
        p.style.transform = '';
        p.style.pointerEvents = '';
      });
      document.querySelectorAll('[data-dropdown-btn]').forEach(b => b.setAttribute('aria-expanded','false'));
    }

    // Wire buttons: click toggles open state
    document.querySelectorAll('[data-dropdown-btn]').forEach(btn => {
      const name = btn.getAttribute('data-dropdown-btn');
      btn.addEventListener('click', function(e){
        e.stopPropagation();
        const panel = panelFor(name);
        const isOpen = panel && panel.classList.contains('open');
        // close others first
        closeAll();
        toggle(name, !isOpen);
      });

      // keyboard: open on Enter/Space
      btn.addEventListener('keydown', function(e){
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          btn.click();
        }
        if (e.key === 'Escape') {
          closeAll();
        }
      });
    });

    // close on outside click
    document.addEventListener('click', function(e){
      // if click is inside any dropdown panel or button, do nothing
      const isInside = !!e.target.closest('[data-dropdown]') || !!e.target.closest('[data-dropdown-btn]');
      if (!isInside) closeAll();
    });

    // close on ESC
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeAll(); });

    // On small touch devices group-hover won't trigger, JS will still allow click to open.
    // Optional: close dropdowns on resize to avoid stuck open states
    window.addEventListener('resize', () => closeAll());

    // Mobile menu functionality
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }

    // Mobile dropdown functionality
    document.querySelectorAll('[data-mobile-dropdown]').forEach(btn => {
      btn.addEventListener('click', function() {
        const dropdownName = this.getAttribute('data-mobile-dropdown');
        const content = document.querySelector(`[data-mobile-dropdown-content="${dropdownName}"]`);
        const arrow = this.querySelector('svg');

        if (content) {
          content.classList.toggle('hidden');
          if (arrow) {
            arrow.classList.toggle('rotate-180');
          }
        }
      });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
      if (mobileMenu && mobileMenuBtn &&
          !mobileMenu.contains(e.target) &&
          !mobileMenuBtn.contains(e.target)) {
        mobileMenu.classList.add('hidden');
      }
    });
  })();
</script>

   >
        </div>
    </header>

    <!-- Enhanced content section with better card styling -->
    @section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Enhanced vendor info card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-6">
                <div class="w-28 h-28 rounded-2xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 shadow-md">
                    @php
                        $logo = $vendor->logo ?? null;
                    @endphp
                    @if($logo)
                        <img src="{{ Storage::url($logo) }}" alt="{{ $vendor->business_name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-store text-2xl"></i>
                        </div>
                    @endif
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $vendor->business_name ?? ($vendor->user->name ?? 'Vendor') }}</h1>
                    <p class="text-gray-600 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-2"></i>
                        {{ $vendor->address ?? 'Address not provided' }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('vendor.products.index', $vendor) }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium inline-flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            View all products
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced products section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-star text-orange-500 mr-3"></i>
                Latest products from this vendor
            </h2>

            @if($products->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No products available yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $p)
                        <!-- Enhanced product cards with hover effects -->
                        <div class="bg-white rounded-xl shadow-md card-hover border border-gray-100 overflow-hidden">
                            <a href="{{ route('products.show', $p) }}" class="block">
                                <div class="relative">
                                    <img src="{{ optional($p->images->first())->path ? Storage::url($p->images->first()->path) : 'https://via.placeholder.com/400x300' }}"
                                         class="w-full h-48 object-cover" alt="{{ $p->name }}">
                                    <div class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-heart text-gray-400 hover:text-red-500 cursor-pointer"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ Str::limit($p->name, 60) }}</h3>
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-orange-600">{{ number_format($p->price, 2) }} ETB</div>
                                    <button class="bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-lg transition-colors">
                                        <i class="fas fa-shopping-cart text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endsection

    @yield('content')

    <!-- Enhanced footer with gradient background and better styling -->
    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <!-- Enhanced footer logo -->
                    <div class="flex items-center mb-6">
                        <div class="nav-gradient text-white p-3 rounded-xl mr-3 shadow-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Nana</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">Your trusted marketplace for quality products from verified vendors across Ethiopia.</p>
                </div>

                <!-- Enhanced footer sections with better styling -->
                <div>
                    <h3 class="font-bold text-lg mb-4 text-orange-400">Quick Links</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center"><i class="fas fa-home w-4 mr-2"></i>Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center"><i class="fas fa-box w-4 mr-2"></i>Products</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4 text-orange-400">Categories</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="text-gray-300 flex items-center"><i class="fas fa-laptop w-4 mr-2"></i>Electronics</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-tshirt w-4 mr-2"></i>Fashion</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-home w-4 mr-2"></i>Home & Garden</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-book w-4 mr-2"></i>Books</li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4 text-orange-400">Customer Service</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="text-gray-300 flex items-center"><i class="fas fa-phone w-4 mr-2"></i>Contact Us</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-question-circle w-4 mr-2"></i>Help Center</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-shipping-fast w-4 mr-2"></i>Shipping Info</li>
                        <li class="text-gray-300 flex items-center"><i class="fas fa-undo w-4 mr-2"></i>Returns</li>
                    </ul>
                </div>
            </div>

            <!-- Enhanced footer bottom with better styling -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300 text-sm">&copy; {{ date('Y') }} Nana Marketplace. All rights reserved.</p>
                <div class="flex justify-center space-x-6 mt-4">
                    <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Added mobile navigation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileVendorsBtn = document.getElementById('mobile-vendors-btn');
            const mobileVendorsMenu = document.getElementById('mobile-vendors-menu');
            const mobileCategoriesBtn = document.getElementById('mobile-categories-btn');
            const mobileCategoriesMenu = document.getElementById('mobile-categories-menu');

            // Toggle mobile menu
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('show');
                });
            }

            // Toggle mobile vendors dropdown
            if (mobileVendorsBtn && mobileVendorsMenu) {
                mobileVendorsBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileVendorsMenu.classList.toggle('hidden');
                });
            }

            // Toggle mobile categories dropdown
            if (mobileCategoriesBtn && mobileCategoriesMenu) {
                mobileCategoriesBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileCategoriesMenu.classList.toggle('hidden');
                });
            }

            // Close mobile menu when clicking outside
            document.addEventListener('click', function() {
                if (mobileMenu) {
                    mobileMenu.classList.remove('show');
                }
                if (mobileVendorsMenu) {
                    mobileVendorsMenu.classList.add('hidden');
                }
                if (mobileCategoriesMenu) {
                    mobileCategoriesMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
