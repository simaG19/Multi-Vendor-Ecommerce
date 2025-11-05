<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Products | Chaka Shoping </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .floating-particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hover-scale {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Floating Background Particles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-particle w-20 h-20 top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="floating-particle w-16 h-16 top-20 right-20" style="animation-delay: 1s;"></div>
        <div class="floating-particle w-12 h-12 bottom-20 left-20" style="animation-delay: 2s;"></div>
        <div class="floating-particle w-24 h-24 bottom-10 right-10" style="animation-delay: 3s;"></div>
        <div class="floating-particle w-8 h-8 top-1/2 left-1/3" style="animation-delay: 4s;"></div>
        <div class="floating-particle w-14 h-14 top-1/3 right-1/3" style="animation-delay: 5s;"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Chaka Shoping Admin</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="text-white hover:text-white transition-colors duration-200 flex items-center space-x-2 border-b-2 border-orange-400">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-store"></i>
                        <span>Vendors</span>
                    </a>
                    <a href="my/orders" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>

                       <a href="{{ route('admin.categories.index') }}" class="text-white-500 font-semibold">
                        <i class="fas fa-tags mr-2"></i>Categories
                    </a>

                </div>

                <!-- inline form, works without JavaScript -->
<form action="{{ route('logout') }}" method="POST" class="inline">
  @csrf
  <button type="submit"
          class="text-white-b-2 pb-1 transition-colors duration-200 flex items-center space-x-2 hover:opacity-90">
    <span>Logout</span>
  </button>
</form>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-white hover:text-orange-200 transition-colors duration-200">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden md:block">Admin</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8 relative z-10">
        <!-- Header Section -->
        <div class="glass-effect rounded-2xl p-6 mb-8 border border-white/20">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Product Management</h1>
                    <p class="text-white/80">Manage your marketplace products</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 hover-scale flex items-center space-x-2 shadow-lg">
                    <i class="fas fa-plus"></i>
                    <span>Create Product</span>
                </a>
            </div>
        </div>

        <!-- Search Section -->
        <div class="glass-effect rounded-2xl p-6 mb-8 border border-white/20">
            <form method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products by name, vendor, or category..."
                           class="w-full pl-12 pr-4 py-3 bg-white/90 border border-white/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300">
                </div>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover-scale flex items-center space-x-2">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </button>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="glass-effect rounded-2xl p-4 mb-8 border border-green-300/30 bg-green-50/20">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle text-green-400 text-xl"></i>
                <span class="text-white font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $p)
            <div class="product-card rounded-2xl p-6 hover-scale">
                <!-- Product Image -->
                <div class="relative mb-4">
                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden">
                        @if($p->images->first())
                            <img src="{{ \Storage::url($p->images->first()->path) }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                    <div class="text-sm text-gray-400">No image</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Price Badge -->
                    <div class="absolute top-3 right-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ number_format($p->price, 2) }} ETB
                    </div>

                    @if($p->created_by)
        <div class="mt-1 text-xs inline-block px-2 py-1 rounded bg-blue-50 text-blue-700">Created by admin</div>
      @endif
                </div>

                <!-- Product Info -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $p->name }}</h3>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <i class="fas fa-store text-orange-500"></i>
                        <span>{{ $p->vendor->business_name ?? $p->vendor->user->name ?? 'Vendor' }}</span>
                    </div>
                </div>

                <!-- Product Stats -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-3 text-center">
                        <div class="text-blue-600 font-semibold">Stock</div>
                        <div class="text-sm text-gray-600">{{ $p->stock ?? 'N/A' }}</div>
                    </div>
                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-3 text-center">
                        <div class="text-green-600 font-semibold">Status</div>
                        <div class="text-sm text-gray-600">Active</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('admin.products.edit', $p) }}" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-center flex items-center justify-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete this product?')" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-2 px-4 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <div class="glass-effect rounded-2xl p-4 border border-white/20">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        // Add loading states for buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                if (button) {
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                    button.disabled = true;
                }
            });
        });

        // Add search functionality
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.closest('form').submit();
                }
            });
        }
    </script>
</body>
</html>
