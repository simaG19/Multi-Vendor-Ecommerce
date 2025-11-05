<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Orders - Chaka Shoping </title>
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

        .order-card {
            transition: all 0.3s ease;
        }

        .order-card:hover {
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
                    <a href="/vendor/products" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-shopping-cart mr-2"></i> Products
                    </a>


                    <a href="/vendor/products" class="text-orange-600 font-medium border-b-2 border-orange-600 pb-1">
                        <i class="fas fa-box mr-2"></i>Orders
                    </a>
                    {{-- <a href="#" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Analytics
                    </a> --}}

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
        <div class="mb-8">
            <h1 class="text-3xl font-bold gradient-text mb-2">Your Orders</h1>
            <p class="text-gray-600">Manage and track orders containing your products</p>
        </div>

        <!-- Orders Content -->
        @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="glass-effect rounded-2xl p-12 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-cart text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Orders Yet</h3>
                <p class="text-gray-600 mb-6">You haven't received any orders for your products yet.</p>
                {{-- <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Products
                </a> --}}
            </div>
        @else
            <!-- Orders Grid -->
            <div class="grid gap-6 md:gap-8">
                @foreach($orders as $order)
                    <div class="order-card glass-effect rounded-2xl p-6 hover:shadow-xl">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <!-- Order Info -->
                            <div class="flex-1">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-receipt text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">#{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-600">Order Number</p>
                                    </div>
                                </div>

                                <!-- Customer Info -->
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div class="bg-white/50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-800 mb-2">
                                            <i class="fas fa-user mr-2 text-orange-600"></i>Customer
                                        </h4>
                                        <p class="text-gray-700 font-medium">{{ $order->user->name ?? '—' }}</p>
                                        <p class="text-sm text-gray-600">{{ $order->user->email ?? '' }}</p>
                                    </div>

                                    <div class="bg-white/50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-800 mb-2">
                                            <i class="fas fa-money-bill-wave mr-2 text-orange-600"></i>Total Amount
                                        </h4>
                                        <p class="text-2xl font-bold gradient-text">{{ number_format($order->total,2) }} ETB</p>
                                    </div>
                                </div>

                                <!-- Your Items -->
                                <div class="bg-white/50 rounded-lg p-4 mb-4">
                                    <h4 class="font-medium text-gray-800 mb-3">
                                        <i class="fas fa-box mr-2 text-orange-600"></i>Your Items in this Order
                                    </h4>
                                    <div class="space-y-2">
                                        @foreach($order->items as $it)
                                            @if($it->product && $it->product->vendor_id == auth()->user()->vendor->id)
                                                <div class="flex items-center justify-between bg-white/70 rounded-lg p-3">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                                            <i class="fas fa-cube text-white text-xs"></i>
                                                        </div>
                                                        <span class="font-medium text-gray-800">{{ $it->product->name }}</span>
                                                    </div>
                                                    <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                                        x{{ $it->quantity }}
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Status and Actions -->
                            <div class="lg:w-48 flex flex-col gap-4">
                                <!-- Status Badge -->
                                <div class="text-center">
                                    <span class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        <i class="fas fa-circle mr-2 text-xs"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <!-- View Button -->
                                <a href="{{ route('vendor.orders.show', $order) }}"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="glass-effect rounded-lg p-4">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>

    <script>
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate order cards on scroll
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

            // Observe all order cards
            document.querySelectorAll('.order-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add click animation to buttons
            document.querySelectorAll('a[href*="orders.show"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1.05)';
                    }, 100);
                });
            });
        });
    </script>
</body>
</html>
