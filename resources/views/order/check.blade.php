<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Your Order - Nana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'golden': {
                            50: '#fefdf8',
                            100: '#fef7cd',
                            200: '#fef08a',
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                            800: '#854d0e',
                            900: '#713f12',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(234, 179, 8, 0.3); }
            50% { box-shadow: 0 0 40px rgba(234, 179, 8, 0.6); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .floating-particle {
            animation: float 6s ease-in-out infinite;
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-yellow-50 to-amber-50 font-sans overflow-x-hidden">

    <!-- Floating Background Particles -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="floating-particle absolute top-20 left-10 w-4 h-4 bg-golden-300 rounded-full opacity-60"></div>
        <div class="floating-particle absolute top-40 right-20 w-6 h-6 bg-orange-300 rounded-full opacity-40" style="animation-delay: -2s;"></div>
        <div class="floating-particle absolute bottom-32 left-1/4 w-3 h-3 bg-yellow-400 rounded-full opacity-50" style="animation-delay: -4s;"></div>
        <div class="floating-particle absolute bottom-20 right-1/3 w-5 h-5 bg-amber-300 rounded-full opacity-30" style="animation-delay: -1s;"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-golden-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-gradient-to-r from-golden-500 to-orange-500 p-2 rounded-lg">
                        <i class="fas fa-shopping-bag text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-golden-600 to-orange-600 bg-clip-text text-transparent">Nana</span>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-golden-600 font-medium transition-colors duration-200">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-golden-600 font-medium transition-colors duration-200">Products</a>
                    <a href="#" class="text-gray-700 hover:text-golden-600 font-medium transition-colors duration-200">Vendors</a>
                    <a href="#" class="text-gray-700 hover:text-golden-600 font-medium transition-colors duration-200">Categories</a>
                </div>

                <!-- Cart and User -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-golden-600 transition-colors duration-200">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-golden-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                    @auth
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-golden-600 transition-colors duration-200">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            </button>
                        </div>
                    @else
                        {{-- <a href="{{ route('login') }}" class="bg-golden-500 hover:bg-golden-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Sign In
                        </a> --}}
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-3xl p-8 sm:p-12 w-full max-w-md transform transition-all duration-500 hover:scale-[1.02] pulse-glow border border-golden-200">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-golden-400 to-orange-400 text-white mb-6 shadow-lg">
                    <i class="fas fa-search text-3xl"></i>
                </div>
                <h1 class="text-4xl font-extrabold bg-gradient-to-r from-golden-600 to-orange-600 bg-clip-text text-transparent mb-3">
                    Track Your Order
                </h1>
                <p class="text-gray-600 text-lg">Enter your 6-character Order ID to check status</p>
            </div>

            <!-- Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-xl text-red-700 text-sm animate-pulse">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        {{ $errors->first('order_number') }}
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('order.check.redirect') }}" class="space-y-6">
                @csrf

                <div class="relative group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order ID</label>
                    <input
                        type="text"
                        name="order_number"
                        placeholder="A9X4B2"
                        class="w-full px-6 py-4 border-2 border-golden-200 rounded-xl focus:ring-4 focus:ring-golden-300 focus:border-golden-500 outline-none uppercase tracking-[0.4em] text-center text-xl font-bold text-gray-800 placeholder-gray-400 transition-all duration-300 group-hover:border-golden-300 bg-gradient-to-r from-white to-golden-50"
                        maxlength="6"
                        required
                    >
                    <div class="absolute inset-0 rounded-xl shimmer opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                </div>

                <button
                    type="submit"
                    class="w-full py-4 bg-gradient-to-r from-golden-500 via-orange-500 to-golden-600 hover:from-golden-600 hover:via-orange-600 hover:to-golden-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden group"
                >
                    <span class="relative z-10 flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i>
                        Check Order Status
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </form>

            <!-- Help Section -->
            <div class="mt-8 text-center">
                <div class="bg-gradient-to-r from-golden-50 to-orange-50 rounded-xl p-4 border border-golden-200">
                    <p class="text-sm text-gray-600 mb-2">
                        <i class="fas fa-question-circle text-golden-500 mr-1"></i>
                        Lost your Order ID?
                    </p>
                    <a href="{{ route('products.index') }}" class="text-golden-600 hover:text-golden-700 font-semibold hover:underline transition-colors duration-200">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center text-xs text-gray-500">
                <p>Order IDs are case-insensitive and contain 6 characters</p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Enhanced Interactions -->
    <script>
        // Auto-uppercase input
        document.querySelector('input[name="order_number"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = e.target.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Checking...';
            button.disabled = true;

            // Re-enable after 5 seconds as fallback
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 5000);
        });

        // Add floating animation to particles
        document.querySelectorAll('.floating-particle').forEach((particle, index) => {
            particle.style.animationDelay = `-${index * 1.5}s`;
            particle.style.animationDuration = `${6 + index}s`;
        });
    </script>
</body>
</html>
