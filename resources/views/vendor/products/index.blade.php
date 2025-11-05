<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaka Shoping </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
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
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 120px; height: 120px; left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 60px; height: 60px; left: 60%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 100px; height: 100px; left: 80%; animation-delay: 1s; }
        .particle:nth-child(5) { width: 40px; height: 40px; left: 70%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(237, 137, 54, 0.2);
        }

        .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .gradient-text {
            background: linear-gradient(45deg, #ed8936, #dd6b20);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-100">
    <!-- Floating Background Particles -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Vendor Navigation -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-orange-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-store text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold gradient-text">Vendor Panel</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    {{-- <a href="#" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a> --}}
                    <a href="/vendor/orders" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                    <a href="/vendor/products" class="text-orange-600 font-medium border-b-2 border-orange-600 pb-1">
                        <i class="fas fa-box mr-2"></i>Products
                    </a>
                    {{-- <a href="#" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Analytics
                    </a> --}}

                    <form action="{{ route('logout') }}" method="POST" class="inline">
  @csrf
  <button type="submit"
          class="text-white-b-2 pb-1 transition-colors duration-200 flex items-center space-x-2 hover:opacity-90">
    <span>Logout</span>
  </button>
</form>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold gradient-text mb-2">Your Products</h1>
                <p class="text-gray-600">Manage your product inventory and listings</p>
            </div>
            <a href="{{ route('vendor.products.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105 mt-4 md:mt-0">
                <i class="fas fa-plus mr-2"></i>Add Product
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="glass-effect rounded-lg p-4 mb-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Products Content -->
        @if($products->isEmpty())
            <!-- Empty State -->
            <div class="glass-effect rounded-2xl p-12 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-box text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Products Yet</h3>
                <p class="text-gray-600 mb-6">Start building your inventory by adding your first product.</p>
                <a href="{{ route('vendor.products.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Your First Product
                </a>
            </div>
        @else
            <!-- Products Grid -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $p)
                    <div class="product-card glass-effect rounded-2xl p-6 hover:shadow-xl">
                        <!-- Product Image -->
                        <div class="relative mb-4">
                            <div class="w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                                @if($p->images->isNotEmpty())
                                    <img src="{{ asset('storage/'.$p->images->first()->path) }}"
                                         alt="{{ $p->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <i class="fas fa-image text-gray-400 text-3xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $p->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    {{ $p->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $p->name }}</h3>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="bg-white/50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">Price</p>
                                    <p class="text-lg font-bold gradient-text">{{ number_format($p->price,2) }} ETB</p>
                                </div>
                                <div class="bg-white/50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 mb-1">Stock</p>
                                    <p class="text-lg font-bold {{ $p->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $p->stock }}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-white/50 rounded-lg p-3 mb-4">
                                <p class="text-xs text-gray-600 mb-1">Product ID</p>
                                <p class="text-sm font-mono text-gray-800">#{{ $p->id }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('vendor.products.edit', $p) }}"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>

                            <form action="{{ route('vendor.products.destroy', $p) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="glass-effect rounded-lg p-4">
                    {{ $products->links() }}
                </div>
            </div>
        @endif
    </div>

    <script>
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate product cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all product cards
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add click animation to buttons
            document.querySelectorAll('a, button').forEach(button => {
                button.addEventListener('click', function(e) {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
            });
        });
    </script>
</body>
</html>
