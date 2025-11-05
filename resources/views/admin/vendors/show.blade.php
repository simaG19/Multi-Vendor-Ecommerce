<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Orders - Admin Dashboard</title>
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
<body class="bg-gradient-to-br from-orange-50 to-yellow-50 min-h-screen">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Admin Navigation -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-orange-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold gradient-text">Chaka Shoping Admin</h1>
                        <p class="text-xs text-gray-600">Vendor Management</p>
                    </div>
                </div>

                <!-- Admin Menu -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-orange-600 transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                    </a>
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="glass-effect rounded-2xl p-6 border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold gradient-text mb-2">Vendor Orders</h2>
                        <p class="text-gray-600">Orders containing {{ $vendor->name ?? 'this vendor' }}'s products</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-orange-600">{{ $vendorOrders->total() ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Total Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        @if($vendorOrders->isEmpty())
            <!-- Empty State -->
            <div class="glass-effect rounded-2xl p-12 text-center border border-orange-200">
                <div class="w-24 h-24 bg-gradient-to-r from-orange-100 to-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-cart text-orange-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Orders Yet</h3>
                <p class="text-gray-500">This vendor hasn't received any orders yet.</p>
            </div>
        @else
            <!-- Orders Grid -->
            <div class="space-y-4">
                @foreach($vendorOrders as $order)
                    <div class="order-card glass-effect rounded-2xl p-6 border border-orange-200">
                        <div class="grid grid-cols-1 lg:grid-cols-6 gap-4 items-center">
                            <!-- Order ID -->
                            <div class="lg:col-span-1">
                                <div class="text-sm text-gray-500 mb-1">Order ID</div>
                                <div class="font-mono text-lg font-semibold gradient-text">#{{ $order->id }}</div>
                            </div>

                            <!-- Customer Info -->
                            <div class="lg:col-span-1">
                                <div class="text-sm text-gray-500 mb-1">Customer</div>
                                <div class="font-semibold text-gray-800">{{ $order->user->name ?? '—' }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email ?? '' }}</div>
                            </div>

                            <!-- Total -->
                            <div class="lg:col-span-1">
                                <div class="text-sm text-gray-500 mb-1">Total</div>
                                <div class="text-xl font-bold text-green-600">{{ number_format($order->total,2) }} ETB</div>
                            </div>

                            <!-- Items -->
                            <div class="lg:col-span-2">
                                <div class="text-sm text-gray-500 mb-1">Vendor Items</div>
                                <div class="space-y-1">
                                    @foreach($order->items as $it)
                                        @if($it->product && $it->product->vendor_id == $vendor->id)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-8 h-8 bg-gradient-to-r from-orange-100 to-yellow-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-box text-orange-500 text-xs"></i>
                                                </div>
                                                <div class="text-sm">
                                                    <span class="font-medium">{{ $it->product->name }}</span>
                                                    <span class="text-gray-500">x {{ $it->quantity }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Status & Actions -->
                            <div class="lg:col-span-1 flex flex-col items-end space-y-3">
                                <!-- Status Badge -->
                                <div class="status-badge px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </div>

                                <!-- Action Button -->
                                {{-- <a href="{{ route('admin.vendors.show', $vendor) }}#order-{{ $order->id }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-yellow-500 text-white text-sm font-medium rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-eye mr-2"></i>
                                    View Details
                                </a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="glass-effect rounded-2xl p-4 border border-orange-200">
                    {{ $vendorOrders->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- JavaScript for Enhanced Interactions -->
    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Add loading states to action buttons
        document.querySelectorAll('a[href*="admin"]').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.className = 'fas fa-spinner fa-spin mr-2';
                }
            });
        });

        // Add hover effects to order cards
        document.querySelectorAll('.order-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 20px 40px rgba(237, 137, 54, 0.2)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    </script>
</body>
</html>
