<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders - NanaMarketplace</title>
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

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .order-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-shipped { background: #d1fae5; color: #065f46; }
        .status-delivered { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .search-container {
            position: relative;
            overflow: hidden;
        }

        .search-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .search-container:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; top: 20%; width: 10px; height: 10px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; top: 80%; width: 15px; height: 15px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 60%; top: 30%; width: 8px; height: 8px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 80%; top: 70%; width: 12px; height: 12px; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; top: 10%; width: 6px; height: 6px; animation-delay: 3s;"></div>
        <div class="particle" style="left: 70%; top: 90%; width: 14px; height: 14px; animation-delay: 5s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Nana Admin</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-store"></i>
                        <span>Vendors</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="text-white border-b-2 border-orange-400 pb-1 transition-colors duration-200 flex items-center space-x-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>

                       <a href="{{ route('admin.categories.index') }}" class="text-white-500 font-semibold">
                        <i class="fas fa-tags mr-2"></i>Categories
                    </a>


<!-- inline form, works without JavaScript -->
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
                    <div class="text-white text-sm">
                        <i class="fas fa-user-circle text-lg mr-2"></i>
                        Admin
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="glass-effect rounded-2xl p-6 mb-8 border border-white/20">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        <i class="fas fa-shopping-cart text-orange-400 mr-3"></i>
                        Orders Management
                    </h1>
                    <p class="text-white/80">Manage orders containing admin-created products</p>
                </div>

                <!-- Search Form -->
                <form method="GET" class="flex items-center gap-3">
                    <div class="search-container relative">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search order number or customer..."
                            class="px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent backdrop-blur-sm w-80"
                        >
                        <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60"></i>
                    </div>
                    <button class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-xl hover:from-orange-500 hover:to-orange-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/20 border border-green-400/30 text-green-100 rounded-xl backdrop-blur-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/20 border border-red-400/30 text-red-100 rounded-xl backdrop-blur-sm">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
        @endif

        <!-- Orders Content -->
        @if($orders->isEmpty())
            <div class="glass-effect rounded-2xl p-12 text-center border border-white/20">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-cart text-4xl text-white/60"></i>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">No Orders Found</h3>
                <p class="text-white/70">No orders found for admin-created products.</p>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($orders as $order)
                <div class="order-card rounded-2xl p-6 border border-white/20 shadow-lg">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <!-- Order Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-2xl font-bold text-gray-800 hover:text-orange-600 transition-colors duration-200">
                                    Order #{{ $order->order_number }}
                                </a>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user text-orange-500"></i>
                                    <span><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar text-orange-500"></i>
                                    <span><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-box text-orange-500"></i>
                                    <span><strong>Total Items:</strong> {{ $order->items->count() }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-star text-orange-500"></i>
                                    <span><strong>Admin Items:</strong> {{ $order->items->filter(fn($it)=> $it->product && $it->product->created_by )->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-800">
                                    {{ number_format($order->total ?? 0, 2) }} ETB
                                </div>
                                <div class="text-sm text-gray-500">Total Amount</div>
                            </div>
                            <a href="{{ route('admin.orders.show', $order) }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                                <i class="fas fa-eye"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="glass-effect rounded-xl p-4 border border-white/20">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>

    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add loading state to search form
        document.querySelector('form').addEventListener('submit', function() {
            const button = this.querySelector('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        });

        // Add hover effects to order cards
        document.querySelectorAll('.order-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
