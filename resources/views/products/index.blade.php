<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Your Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Added navbar from index page replacing app-layout -->
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">

                            <img src="img/logo2.png" style='height: 63px'; width='140px'>

                        </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 transition-colors duration-200">Home</a>
                    <a href="{{ route('products.index') }}" class="text-orange-500 font-semibold">Products</a>

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
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div
                            class="origin-top-left absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black/5 opacity-0 scale-95 transform transition-all duration-150 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto"
                            data-dropdown="categories"
                        >
                            <div class="p-3">
                                <div class="text-xs text-gray-400 uppercase font-medium mb-2">Browse categories</div>
                                <div class="grid grid-cols-1 gap-2">
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
                                <div class="mt-3 border-t pt-3">
                                    <a href="{{ url('/categories') }}" class="text-sm text-golden-600 hover:underline">View all categories →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-lg mx-8">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Search products..."
                                   class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:bg-white focus:border-orange-500 transition-colors">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Cart -->
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

                    <!-- User Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 transition-colors">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            </button>
                            <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-2">
                                    <a href="{{ route('profile.show') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded">Profile</a>
                                    <a href="{{ route('orders.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded">Orders</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 transition-colors">
                            <i class="fas fa-sign-in-alt text-xl"></i>
                            <span class="hidden md:inline ml-1">Login</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Navigation -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 hover:text-orange-500 focus:outline-none focus:text-orange-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Converted Laravel Blade content to standalone HTML -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <x-sidebar :categories="$categories" :vendors="$vendors" :brands="$brands" />
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Flash Deal Section -->
                @if($discounted->count() > 0)
                    <x-flash-deal :discountedProducts="$discounted" />
                @endif

                <!-- Hero Banner -->
                <!-- Compact dismissible hero advert (replace original banner with this block) -->
                <div id="promo-banner" class="bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-lg p-4 md:p-6 mb-8 relative overflow-hidden transition-all" role="region" aria-label="Promotional banner">
                    <!-- Close button -->
                    <button id="promo-close" aria-label="Close advertisement" title="Close" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition text-white">
                        <span class="text-xl leading-none">×</span>
                    </button>

                    <div class="relative z-10 flex items-center gap-6">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-xl md:text-2xl font-bold mb-1">Fast &amp; Reliable</h1>
                            <h2 class="text-lg md:text-xl font-semibold mb-2">Local <span class="text-amber-200">Delivery</span></h2>
                            <p class="text-sm md:text-base mb-3 max-w-md text-white/95">Get your packages delivered quickly and safely across the city — same-day delivery available.</p>

                            <div class="flex items-center gap-3">
                                <a href="https://nanaexpresset.com/" class="inline-flex items-center bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    <i class="fas fa-paper-plane mr-2"></i> Ship Now!
                                </a>

                                <!-- small stats (compact) -->
                                <div class="hidden md:flex items-center gap-6 ml-4 text-sm text-amber-100">
                                    <div class="text-center">
                                        <div class="text-lg font-bold">{{ $products->total() ?? 0 }}</div>
                                        <div class="text-xs">Products</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold">99%</div>
                                        <div class="text-xs">Satisfaction</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold">24/7</div>
                                        <div class="text-xs">Support</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Decorative icon (smaller, subtle) -->
                        <div class="hidden md:block absolute right-6 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none">
                            <i class="fas fa-shipping-fast text-6xl"></i>
                        </div>
                    </div>
                </div>

                <script>
                    (function(){
                        const banner = document.getElementById('promo-banner');
                        const closeBtn = document.getElementById('promo-close');

                        // If user already dismissed, hide immediately
                        try {
                            if (localStorage.getItem('promoBannerHidden') === '1') {
                                banner.style.display = 'none';
                            }
                        } catch (e) {
                            // localStorage might be blocked — ignore
                        }

                        // Close handler with smooth collapse and persist choice
                        closeBtn.addEventListener('click', function () {
                            banner.style.transition = 'opacity .35s ease, height .35s ease, margin .35s ease, padding .35s ease';
                            banner.style.opacity = 0;
                            banner.style.height = 0;
                            banner.style.margin = 0;
                            banner.style.padding = 0;
                            // mark dismissed
                            try { localStorage.setItem('promoBannerHidden', '1'); } catch (e) {}
                            // remove from flow after animation
                            setTimeout(() => { banner.style.display = 'none'; }, 360);
                        });
                    })();
                </script>

                <style>
                    /* ensure compact on small devices */
                    #promo-banner { will-change: opacity, height, margin, padding; }
                    @media (min-width: 768px) {
                        #promo-banner { padding-left: 1.5rem; padding-right: 1.5rem; }
                    }
                </style>

                <!-- Products Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            @if(request('q'))
                                Search Results for "{{ request('q') }}"
                            @elseif(request('category_id'))
                                {{ $categories->find(request('category_id'))->name ?? 'Category' }} Products
                            @else
                                All Products
                            @endif
                        </h2>
                        <p class="text-gray-600">{{ $products->total() }} products found</p>
                    </div>

                    <!-- Sort Options -->
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2">
                            <!-- Preserve existing filters -->
                            @foreach(request()->except(['sort', 'page']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                            <label class="text-sm text-gray-600">Sort by:</label>
                            <select name="sort" onchange="this.form.submit()"
                                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
                        <p class="text-gray-500">Try adjusting your search or filter criteria</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="md:hidden fixed top-16 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-40 transform -translate-y-full opacity-0 transition-all duration-300 ease-in-out" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 max-h-screen overflow-y-auto">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Home</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 text-orange-500 font-semibold bg-orange-50 rounded-md">Products</a>

            <!-- Mobile Vendors Dropdown -->
            <div class="relative">
                <button id="mobile-vendors-btn" class="w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">
                    <span>Vendors</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" id="mobile-vendors-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="mobile-vendors-menu" class="hidden mt-1 ml-4 space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-md">
                        <img src="https://via.placeholder.com/32" alt="Vendor" class="w-6 h-6 rounded-full object-cover">
                        <div>
                            <div class="font-medium">Sample Vendor</div>
                            <div class="text-xs text-gray-500">Addis Ababa</div>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-md">
                        <img src="https://via.placeholder.com/32" alt="Vendor" class="w-6 h-6 rounded-full object-cover">
                        <div>
                            <div class="font-medium">Another Vendor</div>
                            <div class="text-xs text-gray-500">Dire Dawa</div>
                        </div>
                    </a>
                    <a href="{{ url('/vendors') }}" class="block px-3 py-2 text-sm text-orange-500 hover:underline">View all vendors →</a>
                </div>
            </div>

            <!-- Mobile Categories Dropdown -->
            <div class="relative">
                <button id="mobile-categories-btn" class="w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">
                    <span>Categories</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200" id="mobile-categories-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="mobile-categories-menu" class="hidden mt-1 ml-4 space-y-1">
                    <a href="{{ url('/products?category=1') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-md">Electronics</a>
                    <a href="{{ url('/products?category=2') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-md">Fashion</a>
                    <a href="{{ url('/products?category=3') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-500 hover:bg-gray-50 rounded-md">Home & Garden</a>
                    <a href="{{ url('/categories') }}" class="block px-3 py-2 text-sm text-orange-500 hover:underline">View all categories →</a>
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="px-3 py-2">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Search products..." class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:bg-white focus:border-orange-500 transition-colors">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Mobile User Menu -->
            @auth
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <div class="px-3 py-2 text-sm text-gray-500">{{ Auth::user()->name }}</div>
                    <a href="{{ route('profile.show') }}" class="block px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Profile</a>
                    <a href="{{ route('orders.index') }}" class="block px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Orders</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">Logout</button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Added proper footer section -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-2 rounded-lg">
                            <i class="fas fa-shopping-bag text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">Chaka Shoping</span>
                    </div>
                    <p class="text-gray-300 mb-4 max-w-md">
                        Your trusted marketplace for quality products with fast and reliable delivery across Ethiopia.
                        Shop with confidence and get the best deals on electronics, fashion, and more.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Products</a></li>
                        <li><a href="{{ url('/vendors') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Vendors</a></li>
                        <li><a href="{{ url('/categories') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Categories</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">About Us</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">Returns</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-orange-500 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm">
                    © 2024 Chaka Shoping Marketplace. All rights reserved.
                </p>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <span class="text-gray-300 text-sm">We accept:</span>
                    <div class="flex space-x-2">
                        <div class="bg-white rounded px-2 py-1">
                            <span class="text-xs font-bold text-gray-800">VISA</span>
                        </div>
                        <div class="bg-white rounded px-2 py-1">
                            <span class="text-xs font-bold text-gray-800">MC</span>
                        </div>
                        <div class="bg-white rounded px-2 py-1">
                            <span class="text-xs font-bold text-orange-600">PayPal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Enhanced mobile menu JavaScript with better animations and touch support -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('[v0] Mobile menu script loaded');

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (!mobileMenuBtn || !mobileMenu) {
                console.log('[v0] Error: Mobile menu elements not found');
                return;
            }

            console.log('[v0] Mobile menu elements found');

            // Enhanced mobile menu toggle with smooth animations
            mobileMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('[v0] Mobile menu button clicked');

                const isHidden = mobileMenu.style.display === 'none' || mobileMenu.style.display === '';
                console.log('[v0] Menu is currently hidden:', isHidden);

                if (isHidden) {
                    // Show menu with animation
                    mobileMenu.style.display = 'block';
                    mobileMenu.style.transform = 'translateY(-100%)';
                    mobileMenu.style.opacity = '0';

                    // Force reflow
                    mobileMenu.offsetHeight;

                    // Animate in
                    mobileMenu.style.transform = 'translateY(0)';
                    mobileMenu.style.opacity = '1';
                    console.log('[v0] Showing mobile menu');
                } else {
                    // Hide menu with animation
                    mobileMenu.style.transform = 'translateY(-100%)';
                    mobileMenu.style.opacity = '0';

                    setTimeout(() => {
                        mobileMenu.style.display = 'none';
                    }, 300);
                    console.log('[v0] Hiding mobile menu');
                }
            });

            // Mobile vendors dropdown
            const mobileVendorsBtn = document.getElementById('mobile-vendors-btn');
            const mobileVendorsMenu = document.getElementById('mobile-vendors-menu');
            const mobileVendorsIcon = document.getElementById('mobile-vendors-icon');

            if (mobileVendorsBtn && mobileVendorsMenu && mobileVendorsIcon) {
                mobileVendorsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('[v0] Mobile vendors button clicked');

                    const isHidden = mobileVendorsMenu.classList.contains('hidden');
                    mobileVendorsMenu.classList.toggle('hidden');
                    mobileVendorsIcon.classList.toggle('rotate-180');
                    console.log('[v0] Vendors menu toggled, hidden:', !isHidden);
                });
            }

            // Mobile categories dropdown
            const mobileCategoriesBtn = document.getElementById('mobile-categories-btn');
            const mobileCategoriesMenu = document.getElementById('mobile-categories-menu');
            const mobileCategoriesIcon = document.getElementById('mobile-categories-icon');

            if (mobileCategoriesBtn && mobileCategoriesMenu && mobileCategoriesIcon) {
                mobileCategoriesBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('[v0] Mobile categories button clicked');

                    const isHidden = mobileCategoriesMenu.classList.contains('hidden');
                    mobileCategoriesMenu.classList.toggle('hidden');
                    mobileCategoriesIcon.classList.toggle('rotate-180');
                    console.log('[v0] Categories menu toggled, hidden:', !isHidden);
                });
            }

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.style.transform = 'translateY(-100%)';
                    mobileMenu.style.opacity = '0';
                    setTimeout(() => {
                        mobileMenu.style.display = 'none';
                    }, 300);
                    console.log('[v0] Mobile menu closed by outside click');
                }
            });

            // Touch support for mobile devices
            let touchStartY = 0;
            mobileMenuBtn.addEventListener('touchstart', function(e) {
                touchStartY = e.touches[0].clientY;
                console.log('[v0] Mobile menu button touched');
            });

            mobileMenuBtn.addEventListener('touchend', function(e) {
                const touchEndY = e.changedTouches[0].clientY;
                const touchDiff = Math.abs(touchEndY - touchStartY);

                // Only trigger if it's a tap (not a swipe)
                if (touchDiff < 10) {
                    e.preventDefault();
                    mobileMenuBtn.click();
                }
            });
        });
    </script>

</body>
</html>
