<!DOCTYPE
html >
  <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaka Shoping - Multi Vendor eCommerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {\
            theme: {\
                extend: {\
                    colors: {\
                        'golden\': {\
                            50: '#fefdf8',
                            100: '#fef7e0',
                            200: '#fdecc8',
                            300: '#fbd38d',
                            400: '#f6ad55',
                            500: '#ed8936',
                            600: '#dd6b20',
                            700: '#c05621',
                            800: '#9c4221',
                            900: '#7c2d12'
                        }
                    },
                    animation: {
                        'fade-in\': \'fadeIn 0.6s ease-out',
                        'slide-up\': \'slideUp 0.8s ease-out',
                        'bounce-gentle\': \'bounceGentle 2s infinite',
                        'pulse-slow\': \'pulse 3s infinite',
                        'float\': \'float 6s ease-in-out infinite',
                        'shimmer\': \'shimmer 2s linear infinite',
                    },
                    keyframes: {\
                        fadeIn: {
                            '0%\': { opacity: \'0\', transform: \'translateY(20px)' },
                            '100%\': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%\': { opacity: \'0\', transform: \'translateY(40px)' },
                            '100%\': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 100%\': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        shimmer: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .product-card {
            transition: all 0.3s ease;
            will-change: transform;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-image {
            transition: transform 0.5s ease;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .slider-slide {
            min-width: 100%;
            position: relative;
        }

        .category-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #fef7e0, #fdecc8);
        }

        .vendor-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .vendor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .vendor-card:hover::before {
            left: 100%;
        }

        .vendor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.3);
        }

        .countdown-timer {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            animation: pulse-slow 2s infinite;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(237, 137, 54, 0.1), transparent);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-elements::before {
            top: 10%;
            left: 10%;
            animation-delay: -2s;
        }

        .floating-elements::after {
            bottom: 10%;
            right: 10%;
            animation-delay: -4s;
        }

        .shimmer-effect {
            position: relative;
            overflow: hidden;
        }

        .shimmer-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2">
                       <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">

                            <img src="img/logo2.png" style='height: 63px'; width='140px'>

                        {{-- <span class="text-2xl font-bold text-gray-800">Chaka Shoping</span> --}}
                    </a>
                </div>

                    </div>
                  @php
  // fallback to empty collections if not provided by controller
  $vendors = $vendors ?? collect();
  $categories = $categories ?? collect();
@endphp

                    <!-- Desktop Navigation - unchanged -->
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-golden-600 transition">Home</a>
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
                    <!-- Search bar - hide on small screens -->
                    <div class="relative hidden sm:block">
                        <input
                            type="text"
                            placeholder="Search products..."
                            class="w-48 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-transparent"
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
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

                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-golden-600 transition" title="View cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount ?: '' }}
                        </span>
                    </a>

                    <!-- Login link - hide text on small screens -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 transition-colors">
                        <i class="fas fa-sign-in-alt text-xl"></i>
                        <span class="hidden md:inline ml-1">Login</span>
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

    <!-- Hero Slider -->
    <section class="relative bg-gradient-to-br from-golden-50 via-white to-golden-100 overflow-hidden">
        <div class="floating-elements"></div>
        <div class="container mx-auto px-6 py-8 relative z-10">
            <div class="slider-container rounded-2xl overflow-hidden shadow-2xl">
                <div class="slider-track" id="heroSlider">
                    <!-- Slide 1 -->
                    <div class="slider-slide">
                        <div class="relative h-96 md:h-[500px]">
                            <img src="https://images.unsplash.com/photo-1526178613552-2b45c6c302f0?auto=format&fit=crop&w=1600&q=80" alt="Summer Sale" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                            <div class="absolute left-8 top-1/2 transform -translate-y-1/2 text-white max-w-lg">
                                <div class="countdown-timer inline-block px-3 py-1 rounded-full text-sm font-semibold mb-4">
                                    <i class="fas fa-clock mr-2"></i>Flash Sale Ends In: <span id="countdown">23:59:45</span>
                                </div>
                                <h2 class="text-4xl md:text-6xl font-bold mb-4 animate-slide-up">Summer Flash Sale</h2>
                                <p class="text-lg md:text-xl mb-6 opacity-90 animate-slide-up" style="animation-delay: 0.2s">Up to 70% off on electronics & fashion</p>
                                <button class="btn-primary text-white px-8 py-3 rounded-lg text-lg font-semibold animate-slide-up" style="animation-delay: 0.4s">
                                    Shop Now <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slider-slide">
                        <div class="relative h-96 md:h-[500px]">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1600&q=80" alt="New Arrivals" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                            <div class="absolute left-8 top-1/2 transform -translate-y-1/2 text-white max-w-lg">
                                <div class="inline-block px-3 py-1 bg-green-500 rounded-full text-sm font-semibold mb-4">
                                    <i class="fas fa-star mr-2"></i>New Arrivals
                                </div>
                                <h2 class="text-4xl md:text-6xl font-bold mb-4">Fashion Forward</h2>
                                <p class="text-lg md:text-xl mb-6 opacity-90">Trendy outfits for every season</p>
                                <button class="btn-primary text-white px-8 py-3 rounded-lg text-lg font-semibold">
                                    Explore Collection <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="slider-slide">
                        <div class="relative h-96 md:h-[500px]">
                            <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=1600&q=80" alt="Kitchen Essentials" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                            <div class="absolute left-8 top-1/2 transform -translate-y-1/2 text-white max-w-lg">
                                <div class="inline-block px-3 py-1 bg-blue-500 rounded-full text-sm font-semibold mb-4">
                                    <i class="fas fa-utensils mr-2"></i>Kitchen & Home
                                </div>
                                <h2 class="text-4xl md:text-6xl font-bold mb-4">Smart Living</h2>
                                <p class="text-lg md:text-xl mb-6 opacity-90">Transform your home with smart tools</p>
                                <button class="btn-primary text-white px-8 py-3 rounded-lg text-lg font-semibold">
                                    Shop Kitchen <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 glass-effect text-white p-3 rounded-full hover:bg-white/20 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 glass-effect text-white p-3 rounded-full hover:bg-white/20 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Indicators -->
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2" id="indicators">
                    <button class="w-3 h-3 rounded-full bg-white transition"></button>
                    <button class="w-3 h-3 rounded-full bg-white/50 transition"></button>
                    <button class="w-3 h-3 rounded-full bg-white/50 transition"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Deal Section -->
<section class="py-12 bg-white scroll-reveal">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">All Products</h3>
                <p class="text-gray-600">Browse everything we have available</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-golden-600 hover:text-golden-700 font-semibold">
                View Catalog <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($allProducts as $product)
                @php
                    $imgModel = $product->images->first() ?? null;
                    $imgUrl = $imgModel && isset($imgModel->path) ? Storage::url($imgModel->path) : 'https://via.placeholder.com/400x300?text=No+image';
                    $discount = $product->discount_percent ?? 0;
                    $finalPrice = $discount > 0 ? ($product->price - ($product->price * $discount / 100)) : $product->price;
                    $vendorName = $product->vendor->business_name ?? $product->vendor->name ?? $product->vendor->user->name ?? 'Unknown Vendor';
                    $rating = $product->rating ?? number_format(4.4 + (rand(0,40)/100),1);
                    $inStock = isset($product->stock) ? ($product->stock > 0) : true;
                @endphp

                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="relative">
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-image w-full h-48 object-cover">
                        </a>

                        @if($discount > 0)
                            <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-semibold">-{{ $discount }}%</div>
                        @endif

                        <div class="absolute top-3 right-3 bg-black/20 text-white p-2 rounded-full">
                            <i class="fas fa-heart"></i>
                        </div>

                        <div class="absolute bottom-3 left-3 {{ $inStock ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }} px-2 py-1 rounded-full text-xs">
                            <i class="fas {{ $inStock ? 'fa-check' : 'fa-times' }} mr-1"></i>
                            {{ $inStock ? 'In Stock' : 'Out of stock' }}
                        </div>
                    </div>

                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-2">
                            <a href="{{ route('products.show', $product) }}">{{ \Illuminate\Support\Str::limit($product->name, 60) }}</a>
                        </h4>

                        <p class="text-gray-600 text-sm mb-3">{{ $vendorName }}</p>

                        <div class="flex items-center justify-between mb-3">
                            <div>
                                @if($discount > 0)
                                    <span class="text-gray-400 line-through text-sm">{{ number_format($product->price, 2) }} ETB</span>
                                    <span class="text-golden-600 font-bold text-xl ml-2">{{ number_format($finalPrice, 2) }} ETB</span>
                                @else
                                    <span class="text-golden-600 font-bold text-xl">{{ number_format($product->price, 2) }} ETB</span>
                                @endif
                            </div>
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star text-sm"></i>
                                <span class="text-gray-600 text-sm ml-1">{{ $rating }}</span>
                            </div>
                        </div>

                        <!-- working add-to-cart form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <input type="hidden" name="quantity" value="1">
  <button type="submit" class="w-full bg-golden-600 hover:bg-golden-700 text-white py-2 rounded-lg">
    <i class="fas fa-shopping-cart"></i> Add to Cart
  </button>
</form>

                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">No products available.</div>
            @endforelse
        </div>

        {{-- pagination --}}
        <div class="mt-6">
            {{ $allProducts->withQueryString()->links() }}
        </div>
    </div>
</section>


    <!-- Categories Section -->
    <section class="py-12 bg-gray-50 scroll-reveal">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Shop by Category</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover amazing products across all categories with the best deals from trusted vendors</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <!-- Updated with real Ethiopian marketplace categories -->
                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-laptop text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Electronics</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-tshirt text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Fashion & Clothing</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-home text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Home & Kitchen</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-seedling text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Spices & Food</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-coffee text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Coffee & Tea</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-palette text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Arts & Crafts</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Books & Education</h4>
                </div>

                <div class="category-card bg-white p-6 rounded-xl text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-car text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-sm">Automotive</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-12 bg-white scroll-reveal">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
  @forelse($featured as $p)
    @php
      $img = ($p->images->first()->path ?? null) ? Storage::url($p->images->first()->path) : 'https://via.placeholder.com/800x500?text=No+image';
      $discount = $p->discount_percent ?? 0;
      $final = $discount > 0 ? ($p->price - ($p->price * ($discount / 100))) : $p->price;
      $rating = $p->rating ?? number_format(4.4 + (rand(0,40)/100),1);
      $inStock = isset($p->stock) ? ($p->stock > 0) : true;
    @endphp

    <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="relative">
        <a href="{{ route('products.show', $p) }}">
          <img src="{{ $img }}" alt="{{ $p->name }}" class="product-image w-full h-48 object-cover">
        </a>

        @if($discount > 0)
          <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-semibold">-{{ $discount }}%</div>
        @endif

        <div class="absolute top-3 right-3 bg-black/20 text-white p-2 rounded-full">
          <i class="fas fa-heart"></i>
        </div>

        <div class="absolute bottom-3 left-3 {{ $inStock ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }} px-2 py-1 rounded-full text-xs">
          <i class="fas {{ $inStock ? 'fa-check' : 'fa-times' }} mr-1"></i>
          {{ $inStock ? 'In Stock' : 'Out of stock' }}
        </div>
      </div>

      <div class="p-4">
        <h4 class="font-semibold text-lg mb-2">
          <a href="{{ route('products.show', $p) }}">{{ \Illuminate\Support\Str::limit($p->name, 60) }}</a>
        </h4>

        <p class="text-gray-600 text-sm mb-3">{{ $p->vendor->business_name ?? $p->vendor->user->name ?? '—' }}</p>

        <div class="flex items-center justify-between mb-3">
          <div>
            @if($discount > 0)
              <span class="text-gray-400 line-through text-sm">{{ number_format($p->price, 0) }} ETB</span>
              <span class="text-golden-600 font-bold text-xl ml-2">{{ number_format($final, 0) }} ETB</span>
            @else
              <span class="text-golden-600 font-bold text-xl">{{ number_format($p->price, 0) }} ETB</span>
            @endif
          </div>
          <div class="flex items-center text-yellow-400">
            <i class="fas fa-star text-sm"></i>
            <span class="text-gray-600 text-sm ml-1">{{ $rating }}</span>
          </div>
        </div>

     <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
  @csrf
  <input type="hidden" name="product_id" value="{{ $p->id }}">
  <input type="hidden" name="quantity" value="1">
  <button type="submit" class="w-full bg-golden-600 hover:bg-golden-700 text-white py-2 rounded-lg flex items-center justify-center gap-2">
    <i class="fas fa-shopping-cart"></i> Add to Cart
  </button>
</form>

      </div>
    </div>
  @empty
    <div class="col-span-4 text-center text-gray-500">No featured products right now.</div>
  @endforelse
</div>

    </section>

 {{-- Top Vendors (real data) --}}
<section class="py-12 bg-gray-50 scroll-reveal">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12">
      <h3 class="text-3xl font-bold text-gray-800 mb-4">Top Vendors</h3>
      <p class="text-gray-600 max-w-2xl mx-auto">Discover amazing products from our verified and trusted vendor partners</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @forelse($vendors as $vendor)
        @php
          // determine display name and location
          $name = $vendor->business_name ?? ($vendor->user->name ?? 'Vendor');
          $location = $vendor->city ?? $vendor->address ?? ($vendor->user->city ?? null) ?? 'Ethiopia';

          // product count (we loaded products_count via withCount)
          $productCount = $vendor->products_count ?? $vendor->products()->count();

          // rating: use vendor->rating if present, otherwise fallback to 4.5
          $rating = isset($vendor->rating) ? number_format($vendor->rating,1) : number_format(4.5 + (rand(0,30)/100),1);

          // logo fallback: vendor->logo -> vendor's first product image -> placeholder
          $logo = null;
          if (!empty($vendor->logo)) {
              $logo = \Illuminate\Support\Facades\Storage::url($vendor->logo);
          } elseif ($vendor->products->isNotEmpty() && $vendor->products[0]->images->isNotEmpty()) {
              $logo = \Illuminate\Support\Facades\Storage::url($vendor->products[0]->images[0]->path);
          } else {
              $logo = 'https://via.placeholder.com/100?text=Vendor';
          }

          // vendor routes (make sure these names exist; earlier we added them)
          $vendorProfileUrl = route_exists('vendor.show') ? route('vendor.show', $vendor->id) : url('vendor/'.$vendor->id);
          $vendorProductsUrl = route_exists('vendor.products.index') ? route('vendor.products.index', $vendor->id) : url('vendor/'.$vendor->id.'/products');
        @endphp

        <div class="vendor-card bg-white rounded-xl p-6 shadow-lg">
          <div class="flex items-center space-x-4 mb-4">
            <img src="{{ $logo }}" alt="{{ $name }}" class="w-16 h-16 rounded-full object-cover">
            <div>
              <h4 class="font-semibold text-lg">{{ $name }}</h4>
              <p class="text-gray-600 text-sm">{{ $location }}</p>
              <div class="flex items-center mt-1">
                <div class="flex text-yellow-400 text-sm">
                  {{-- star icons (rounded) --}}
                  @for($i=1;$i<=5;$i++)
                    @if($i <= floor($rating))
                      <i class="fas fa-star"></i>
                    @elseif($i - $rating < 1)
                      <i class="fas fa-star-half-alt"></i>
                    @else
                      <i class="far fa-star"></i>
                    @endif
                  @endfor
                </div>
                <span class="text-gray-600 text-sm ml-2">{{ $rating }}</span>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
            <span><i class="fas fa-box mr-1"></i>{{ $productCount }} Products</span>
            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Verified</span>
          </div>

          <a href="{{ $vendorProfileUrl }}" class="block w-full btn-primary text-white py-2 rounded-lg text-center bg-golden-600 hover:bg-golden-700 transition">Visit Store</a>
          {{-- <a href="{{ $vendorProductsUrl }}" class="block w-full mt-2 text-center text-golden-800 border border-gray-100 px-3 py-2 rounded hover:bg-gray-50 transition">Products</a> --}}
        </div>

      @empty
        <div class="col-span-4 text-center text-gray-500">
          No vendors available yet.
        </div>
      @endforelse
    </div>
  </div>
</section>

@php
  // helper: check route existence to avoid RouteNotFoundException
  function route_exists($name) {
      try {
          return \Illuminate\Support\Facades\Route::has($name);
      } catch (\Throwable $e) {
          return false;
      }
  }
@endphp

    <!-- Newsletter & CTA -->
    <section class="py-16 parallax-bg relative" style="background-image: linear-gradient(135deg, rgba(237, 137, 54, 0.9), rgba(221, 107, 32, 0.9)), url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1600&q=80');">
        <div class="container mx-auto px-6 text-center text-white">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-4xl font-bold mb-4 animate-bounce-gentle">Join Chaka Shoping Today!</h3>
                <p class="text-xl mb-8 opacity-90">Get exclusive deals, early access to sales, and personalized recommendations</p>

                <div class="flex flex-col md:flex-row gap-4 justify-center items-center mb-8">
                    <div class="flex-1 max-w-md">
                        <input type="email" placeholder="Enter your email address" class="w-full px-6 py-3 rounded-lg text-gray-800 focus:ring-4 focus:ring-white/30 focus:outline-none">
                    </div>
                    <button class="bg-white text-golden-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Subscribe Now
                    </button>
                </div>

                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <button class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/30 transition">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-golden-600 transition">
                        <i class="fas fa-store mr-2"></i>Become a Vendor
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-golden-500 to-golden-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-white">Chaka Shoping</span>
                    </div>
                    <p class="text-sm mb-4">Ethiopia's premier multi-vendor marketplace connecting buyers with trusted local vendors across the country.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-golden-600 transition">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-golden-600 transition">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-golden-600 transition">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-golden-600 transition">
                            <i class="fab fa-telegram text-sm"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-golden-400 transition">Electronics</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Fashion & Clothing</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Home & Kitchen</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Spices & Food</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Coffee & Tea</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Arts & Crafts</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Top Vendors</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-golden-400 transition">TechHub Electronics</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Fashion Forward</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Habesha Crafts</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Merkato Spices</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Jimma Coffee Co</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Awash Books</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-golden-400 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Track Your Order</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Returns & Refunds</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-golden-400 transition">Contact Us</a></li>
                    </ul>

                    <div class="mt-6">
                        <h5 class="text-white font-semibold mb-2">Contact</h5>
                        <p class="text-sm">📞 +251-11-123-4567</p>
                        <p class="text-sm">📧 support@Chaka Shoping.et</p>
                        <p class="text-sm">📍 Addis Ababa, Ethiopia</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; 2024 Chaka Shoping Ethiopia. All rights reserved. | <a href="#" class="hover:text-golden-400">Privacy Policy</a> | <a href="#" class="hover:text-golden-400">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Hero Slider Functionality
        class HeroSlider {
            constructor() {
                this.slider = document.getElementById('heroSlider');
                this.slides = this.slider.children;
                this.totalSlides = this.slides.length;
                this.currentSlide = 0;
                this.indicators = document.querySelectorAll('#indicators button');
                this.autoPlayInterval = null;

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.startAutoPlay();
                this.updateSlider();
            }

            setupEventListeners() {
                document.getElementById('prevBtn').addEventListener('click', () => this.prevSlide());
                document.getElementById('nextBtn').addEventListener('click', () => this.nextSlide());

                this.indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => this.goToSlide(index));
                });

                // Pause autoplay on hover
                this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
                this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
            }

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.updateSlider();
            }

            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.updateSlider();
            }

            goToSlide(index) {
                this.currentSlide = index;
                this.updateSlider();
            }

            updateSlider() {
                const translateX = -this.currentSlide * 100;
                this.slider.style.transform = `translateX(${translateX}%)`;

                // Update indicators
                this.indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('bg-white', index === this.currentSlide);
                    indicator.classList.toggle('bg-white/50', index !== this.currentSlide);
                });
            }

            startAutoPlay() {
                this.autoPlayInterval = setInterval(() => this.nextSlide(), 5000);
            }

            stopAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            }
        }

        // Countdown Timer
        function updateCountdown(elementId, targetTime) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const now = new Date().getTime();
            const distance = targetTime - now;

            if (distance < 0) {
                element.innerHTML = "EXPIRED";
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            element.innerHTML = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // Scroll Reveal Animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');

            reveals.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('revealed');
                }
            });
        }

        // Product Card Interactions
        function setupProductCards() {
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        }

        // Smooth Scrolling for Anchor Links
        function setupSmoothScrolling() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Add to Cart Animation
        function setupAddToCart() {
            const addToCartButtons = document.querySelectorAll('.btn-primary');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.textContent.includes('Add to Cart')) {
                        e.preventDefault();

                        // Create floating animation
                        const rect = this.getBoundingClientRect();
                        const floatingIcon = document.createElement('div');
                        floatingIcon.innerHTML = '<i class="fas fa-shopping-cart"></i>';
                        floatingIcon.style.cssText = `
                            position: fixed;
                            left: ${rect.left + rect.width/2}px;
                            top: ${rect.top}px;
                            z-index: 1000;
                            color: #ed8936;
                            font-size: 20px;
                            pointer-events: none;
                            animation: floatToCart 1s ease-out forwards;
                        `;

                        document.body.appendChild(floatingIcon);

                        // Remove after animation
                        setTimeout(() => {
                            floatingIcon.remove();
                        }, 1000);

                        // Button feedback
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check mr-2"></i>Added!';
                        this.style.background = '#10b981';

                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = '';
                        }, 2000);
                    }
                });
            });
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize hero slider
            new HeroSlider();

            // Setup countdown timers
            const flashSaleEnd = new Date().getTime() + (6 * 60 * 60 * 1000); // 6 hours from now
            const countdownEnd = new Date().getTime() + (24 * 60 * 60 * 1000); // 24 hours from now

            setInterval(() => {
                updateCountdown('countdown', countdownEnd);
                updateCountdown('flashCountdown', flashSaleEnd);
            }, 1000);

            // Setup scroll reveal
            window.addEventListener('scroll', revealOnScroll);
            revealOnScroll(); // Initial check

            // Setup other interactions
            setupProductCards();
            setupSmoothScrolling();
            setupAddToCart();

            // Add CSS for floating cart animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes floatToCart {
                    0% {
                        transform: translateY(0) scale(1);
                        opacity: 1;
                    }
                    100% {
                        transform: translateY(-100px) translateX(200px) scale(0.5);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });

        // Newsletter subscription
        document.querySelector('input[type="email"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const email = this.value;
                if (email) {
                    alert('Thank you for subscribing! We\'ll send you amazing deals.');
                    this.value = '';
                }
            }
        });
    </script>
</body>
</html>
