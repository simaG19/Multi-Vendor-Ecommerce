<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_number }} - Chaka Shoping</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: linear-gradient(45deg, #ed8936, #dd6b20);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.1;
            }
            90% {
                opacity: 0.1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .status-badge {
            animation: pulse 2s infinite;
        }

        .order-item {
            transition: all 0.3s ease;
        }

        .order-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-yellow-50 relative overflow-x-hidden">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; width: 4px; height: 4px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; width: 6px; height: 6px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; width: 3px; height: 3px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 40%; width: 5px; height: 5px; animation-delay: 6s;"></div>
        <div class="particle" style="left: 50%; width: 4px; height: 4px; animation-delay: 8s;"></div>
        <div class="particle" style="left: 60%; width: 6px; height: 6px; animation-delay: 10s;"></div>
        <div class="particle" style="left: 70%; width: 3px; height: 3px; animation-delay: 12s;"></div>
        <div class="particle" style="left: 80%; width: 5px; height: 5px; animation-delay: 14s;"></div>
        <div class="particle" style="left: 90%; width: 4px; height: 4px; animation-delay: 16s;"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="glass-effect shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold gradient-text">Chaka Shoping</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Products</a>

                    <!-- Vendors Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium flex items-center">
                            Vendors <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 glass-effect rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-4">
                                @foreach(\App\Models\Vendor::take(5)->get() as $vendor)
                                {{-- <a href="{{ route('vendors.show', $vendor) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-md transition-colors duration-200">
                                    {{ $vendor->name }}
                                </a> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium flex items-center">
                            Categories <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 glass-effect rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-4">
                                @foreach(\App\Models\Category::take(5)->get() as $category)
                                {{-- <a href="{{ route('categories.show', $category) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-md transition-colors duration-200">
                                    {{ $category->name }}
                                </a> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden md:block">
                        <form action="{{ route('products.index') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Search products..."
                                   class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </form>
                    </div>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
{{--
                    <!-- User Menu -->
                    @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                        </button>
                        <div class="absolute top-full right-0 mt-2 w-48 glass-effect rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="p-2">
                                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-md transition-colors duration-200">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-md transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-4 py-2 rounded-full hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 font-medium">
                        Login
                    </a>
                    @endauth --}}

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 text-gray-700 hover:text-orange-600 transition-colors duration-200" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden glass-effect border-t border-gray-200">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Home</a>
                <a href="{{ route('products.index') }}" class="block text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Products</a>
                <div class="border-t border-gray-200 pt-3">
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Search products..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Order Header -->
        <div class="glass-effect rounded-2xl p-8 mb-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white mb-6 shimmer">
                <i class="fas fa-receipt text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Order #{{ $order->order_number }}</h1>
            <div class="inline-flex items-center px-6 py-3 rounded-full status-badge
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                @elseif($order->status === 'completed') bg-green-100 text-green-800 border border-green-200
                @elseif($order->status === 'cancelled') bg-red-100 text-red-800 border border-red-200
                @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                <i class="fas fa-circle text-xs mr-2"></i>
                <span class="font-semibold">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="glass-effect rounded-2xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-user-circle text-orange-500 mr-3"></i>
                Customer Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 border border-orange-100">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-phone text-orange-500 mr-3"></i>
                        <span class="font-semibold text-gray-700">Phone Number</span>
                    </div>
                    <p class="text-gray-800 font-medium">{{ $order->phone }}</p>
                </div>
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 border border-orange-100">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-3"></i>
                        <span class="font-semibold text-gray-700">Shipping Address</span>
                    </div>
                    <p class="text-gray-800 font-medium">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="glass-effect rounded-2xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-shopping-bag text-orange-500 mr-3"></i>
                Order Items
            </h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="order-item glass-effect rounded-xl p-6 border border-gray-100">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <img src="{{ optional($item->product->images->first())->path ? Storage::url($item->product->images->first()->path) : '/placeholder.svg?height=80&width=80' }}"
                                 class="w-20 h-20 object-cover rounded-xl border-2 border-orange-200"
                                 alt="{{ $item->product->name ?? 'Product' }}">
                            <div class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center font-bold">
                                {{ $item->quantity }}
                            </div>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->product->name ?? 'Unknown Product' }}</h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ number_format($item->price, 2) }} ETB each
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-times mr-1"></i>
                                    {{ $item->quantity }} items
                                </span>
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="text-2xl font-bold gradient-text">
                                {{ number_format($item->quantity * $item->price, 2) }} ETB
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Order Total -->
        <div class="glass-effect rounded-2xl p-8 mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-calculator text-orange-500 mr-3 text-2xl"></i>
                    <span class="text-2xl font-bold text-gray-800">Total Amount</span>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold gradient-text">
                        {{ number_format($order->total, 2) }} ETB
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Screenshot -->
        @if($order->payment_screenshot)
        <div class="glass-effect rounded-2xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-camera text-orange-500 mr-3"></i>
                Payment Proof
            </h2>
            <div class="text-center">
                <img src="{{ Storage::url($order->payment_screenshot) }}"
                     class="max-w-sm mx-auto rounded-xl shadow-lg border-4 border-orange-200 hover:scale-105 transition-transform duration-300"
                     alt="Payment Proof">
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-yellow-500 text-white font-bold rounded-full shadow-lg hover:from-orange-600 hover:to-yellow-600 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-shopping-cart mr-2"></i>
                Continue Shopping
            </a>
            <button onclick="window.print()"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-bold rounded-full shadow-lg hover:from-gray-700 hover:to-gray-800 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-print mr-2"></i>
                Print Order
            </button>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const button = event.target.closest('button');

            if (!menu.contains(event.target) && !button?.onclick?.toString().includes('toggleMobileMenu')) {
                menu.classList.add('hidden');
            }
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
