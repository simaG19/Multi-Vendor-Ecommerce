<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order {{ $order->order_number }} - Chaka Shoping Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            background: linear-gradient(45deg, #ed8936, #dd6b20);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .status-pending { @apply bg-yellow-100 text-yellow-800 border-yellow-200; }
        .status-processing { @apply bg-blue-100 text-blue-800 border-blue-200; }
        .status-shipped { @apply bg-purple-100 text-purple-800 border-purple-200; }
        .status-delivered { @apply bg-green-100 text-green-800 border-green-200; }
        .status-cancelled { @apply bg-red-100 text-red-800 border-red-200; }

        .item-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.1);
            border-color: rgba(237, 137, 54, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(237, 137, 54, 0.4);
        }

        .back-btn {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-btn:hover {
            background: rgba(237, 137, 54, 0.1);
            border-color: rgba(237, 137, 54, 0.3);
            transform: translateX(-2px);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle w-2 h-2" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
        <div class="particle w-3 h-3" style="left: 20%; top: 60%; animation-delay: 1s;"></div>
        <div class="particle w-1 h-1" style="left: 30%; top: 10%; animation-delay: 2s;"></div>
        <div class="particle w-2 h-2" style="left: 40%; top: 70%; animation-delay: 3s;"></div>
        <div class="particle w-3 h-3" style="left: 60%; top: 30%; animation-delay: 4s;"></div>
        <div class="particle w-1 h-1" style="left: 70%; top: 80%; animation-delay: 5s;"></div>
        <div class="particle w-2 h-2" style="left: 80%; top: 15%; animation-delay: 6s;"></div>
        <div class="particle w-3 h-3" style="left: 90%; top: 50%; animation-delay: 7s;"></div>
    </div>

    <!-- Back Navigation -->
    <div class="p-4 sm:p-6">
        <a href="{{ route('admin.orders.index') }}" class="back-btn inline-flex items-center px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 pb-8">
        <div class="glass-effect rounded-2xl p-6 sm:p-8 shadow-xl">
            <!-- Order Header -->
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-8 gap-6">
                <div class="space-y-3">
                    <h1 class="text-3xl sm:text-4xl font-bold gradient-text">Order #{{ $order->order_number }}</h1>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Placed: {{ $order->created_at->format('Y-m-d H:i') }}</span>
                    </div>

                    <!-- Customer Info -->
                    <div class="glass-effect rounded-xl p-4 space-y-2">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Customer Information
                        </h3>
                        {{-- <p class="text-sm"><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                        @if($order->user->email)
                            <p class="text-sm"><strong>Email:</strong> {{ $order->user->email }}</p>
                        @endif --}}
                        <p class="text-sm"><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p class="text-sm"><strong>Shipping:</strong> {{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="text-center lg:text-right">
                    <div class="glass-effect rounded-xl p-6 space-y-2">
                        <div class="text-sm text-gray-600">Order Total</div>
                        <div class="text-3xl sm:text-4xl font-bold gradient-text">{{ number_format($order->total, 2) }} ETB</div>
                        <div class="status-badge status-{{ $order->status }} px-3 py-1 rounded-full text-xs font-medium border inline-block">
                            {{ ucfirst($order->status) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin-owned Items -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Admin-owned Items
                </h3>

                @if($adminItems->isEmpty())
                    <div class="glass-effect rounded-xl p-6 text-center">
                        <div class="text-yellow-600 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600">This order has no admin-created products.</p>
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach($adminItems as $it)
                            <div class="item-card rounded-xl p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ optional($it->product->images->first())->path ? \Storage::url($it->product->images->first()->path) : '/placeholder.svg?height=80&width=80' }}"
                                         class="w-full h-full object-cover" alt="{{ $it->product->name ?? 'Product' }}">
                                </div>
                                <div class="flex-1 space-y-1">
                                    <div class="font-semibold text-gray-800">{{ $it->product->name ?? '—' }}</div>
                                    <div class="text-sm text-gray-600">
                                        Quantity: <span class="font-medium">{{ $it->quantity }}</span> ×
                                        <span class="font-medium">{{ number_format($it->price,2) }} ETB</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold gradient-text">{{ number_format($it->quantity * $it->price,2) }} ETB</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Other Items -->
            @if($otherItems->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Other Items (Vendor Products)
                    </h3>

                    <div class="grid gap-4">
                        @foreach($otherItems as $it)
                            <div class="item-card rounded-xl p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center opacity-75">
                                <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ optional($it->product->images->first())->path ? \Storage::url($it->product->images->first()->path) : '/placeholder.svg?height=80&width=80' }}"
                                         class="w-full h-full object-cover" alt="{{ $it->product->name ?? 'Product' }}">
                                </div>
                                <div class="flex-1 space-y-1">
                                    <div class="font-semibold text-gray-800">{{ $it->product->name ?? '—' }}</div>
                                    <div class="text-sm text-gray-600">
                                        Quantity: <span class="font-medium">{{ $it->quantity }}</span> ×
                                        <span class="font-medium">{{ number_format($it->price,2) }} ETB</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-gray-600">{{ number_format($it->quantity * $it->price,2) }} ETB</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Payment Screenshot -->
            @if($order->payment_screenshot)
                <div class="mb-8">
                    <h4 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Payment Proof
                    </h4>
                    <div class="glass-effect rounded-xl p-4 inline-block">
                        <img src="{{ \Storage::url($order->payment_screenshot) }}"
                             alt="Payment proof"
                             class="max-w-xs rounded-lg border border-gray-200 shadow-lg">
                    </div>
                </div>
            @endif

            <!-- Status Update -->
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Update Order Status
                </h4>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="glass-effect rounded-xl p-6">
                    @csrf
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <label class="text-sm font-medium text-gray-700 flex-shrink-0">Change Status:</label>
                        <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-primary px-6 py-2 text-white rounded-lg font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add smooth animations on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.item-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
