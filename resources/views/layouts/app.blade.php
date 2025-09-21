<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nana - E-commerce Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'golden': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-golden-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <!-- Top Header -->
            <div class="flex items-center justify-between py-3">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-white text-golden-600 p-2 rounded">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">Nana</span>
                </div>

                <!-- Search Bar -->
               <!-- Search Bar (functional) -->
<div class="flex-1 max-w-2xl mx-8">
    <form id="header-search-form" action="{{ route('products.index') }}" method="GET" class="relative">
        <input
            name="q"
            type="text"
            placeholder="Search for items..."
            value="{{ request('q') ?? '' }}"
            class="w-full px-4 py-2 rounded-l-lg text-gray-800 focus:outline-none"
            id="header-search-input"
        >
        <button type="submit" class="absolute right-0 top-0 bg-golden-700 hover:bg-golden-800 px-6 py-2 rounded-r-lg transition-colors">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>


                <!-- Right Icons -->
                <div class="flex items-center space-x-6">
                    <!-- Wishlist -->
                    <div class="relative cursor-pointer hover:text-golden-200 transition-colors">
                        <i class="far fa-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </div>

                    <!-- User Account -->
                    <div class="cursor-pointer hover:text-golden-200 transition-colors">
                        <i class="far fa-user text-xl"></i>
                    </div>

                    <!-- Cart -->
                    <div class="relative cursor-pointer hover:text-golden-200 transition-colors">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                        <div class="text-sm mt-1">
                            <span>My cart</span>
                            <div class="font-semibold">$0.00</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="border-t border-golden-500 py-3">
                <div class="flex items-center space-x-8">
                    <!-- Categories Dropdown -->
                    <div class="relative">
                        <button class="bg-white text-golden-600 px-4 py-2 rounded flex items-center space-x-2 hover:bg-golden-50 transition-colors">
                            <i class="fas fa-th-large"></i>
                            <span class="font-medium">Categories</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-golden-200 transition-colors font-medium">Home</a>
                        <a href="#" class="hover:text-golden-200 transition-colors font-medium">Brand</a>
                        <div class="relative group">
                            <a href="#" class="hover:text-golden-200 transition-colors font-medium flex items-center space-x-1">
                                <span>Offers</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </a>
                        </div>
                        <a href="#" class="hover:text-golden-200 transition-colors font-medium">Publication House</a>
                        <a href="#" class="hover:text-golden-200 transition-colors font-medium">All Vendors</a>
                        <div class="relative group">
                            <a href="#" class="hover:text-golden-200 transition-colors font-medium flex items-center space-x-1">
                                <span>Vendor Zone</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p>&copy; 2024 Nana. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="#" class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg transition-colors">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>
</body>
</html>
