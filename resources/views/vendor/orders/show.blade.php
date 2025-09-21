<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Nana  Marketplace</title>
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
        .particle:nth-child(2) { width: 60px; height: 60px; left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 40px; height: 40px; left: 60%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 100px; height: 100px; left: 80%; animation-delay: 1s; }
        .particle:nth-child(5) { width: 50px; height: 50px; left: 70%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .status-pending { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
        .status-processing { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
        .status-shipped { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
        .status-delivered { background: linear-gradient(135deg, #10b981, #059669); color: white; }
        .status-cancelled { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Floating Particles -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect relative z-10 p-4 mb-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('vendor.orders.index') }}" class="flex items-center space-x-2 text-white hover:text-orange-300 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-semibold">Back to Orders</span>
            </a>

            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-white font-medium">Vendor Portal</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 pb-12 relative z-10">
        <!-- Order Header -->
        <div class="glass-effect rounded-2xl p-8 mb-8 hover-scale">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold gradient-text mb-2">Order #{{ $order->id }}</h1>
                    <p class="text-white/80">Order details and vendor items</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="status-badge status-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Customer Information -->
            <div class="glass-effect rounded-2xl p-6 hover-scale">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    Customer Information
                </h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                        <span class="text-white/70">Name:</span>
                        <span class="text-white font-medium">{{ $order->user->name ?? '—' }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                        <span class="text-white/70">Email:</span>
                        <span class="text-white font-medium">{{ $order->user->email ?? '—' }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                        <span class="text-white/70">Phone:</span>
                        <span class="text-white font-medium">{{ $order->phone }}</span>
                    </div>

                    <div class="p-3 bg-white/5 rounded-lg">
                        <span class="text-white/70 block mb-2">Shipping Address:</span>
                        <span class="text-white font-medium">{{ $order->shipping_address }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="glass-effect rounded-2xl p-6 hover-scale">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                    </svg>
                    Payment Information
                </h2>

                @if($order->payment_screenshot_path)
                    <div class="text-center">
                        <p class="text-white/70 mb-4">Payment Screenshot</p>
                        <a href="{{ Storage::url($order->payment_screenshot_path) }}" target="_blank" rel="noopener" class="block">
                            <img src="{{ Storage::url($order->payment_screenshot_path) }}"
                                 alt="Payment screenshot"
                                 class="max-w-full h-48 object-cover rounded-lg border-2 border-white/20 hover:border-orange-400 transition-colors duration-300 mx-auto">
                        </a>
                        <p class="text-white/50 text-sm mt-2">Click to view full size</p>
                        <p class="text-white/40 text-xs mt-1">File: {{ basename($order->payment_screenshot_path) }}</p>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-white/30 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-white/50">No payment screenshot uploaded for this order</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Vendor Items -->
        <div class="glass-effect rounded-2xl p-6 mt-8 hover-scale">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6a1 1 0 112 0v6H9z" clip-rule="evenodd"></path>
                </svg>
                Your Items in This Order
            </h2>

            <div class="overflow-x-auto">
                <div class="min-w-full">
                    <!-- Header -->
                    <div class="grid grid-cols-4 gap-4 p-4 bg-white/10 rounded-lg mb-4 font-semibold text-white">
                        <div>Product</div>
                        <div class="text-center">Price</div>
                        <div class="text-center">Quantity</div>
                        <div class="text-center">Subtotal</div>
                    </div>

                    <!-- Items -->
                    @foreach($vendorItems as $it)
                        <div class="grid grid-cols-4 gap-4 p-4 bg-white/5 rounded-lg mb-3 hover:bg-white/10 transition-colors duration-300">
                            <div class="text-white font-medium">{{ $it->product->name ?? '—' }}</div>
                            <div class="text-center text-orange-300 font-semibold">{{ number_format($it->price,2) }} ETB</div>
                            <div class="text-center text-white">{{ $it->quantity }}</div>
                            <div class="text-center text-green-300 font-bold">{{ number_format($it->price * $it->quantity,2) }} ETB</div>
                        </div>
                    @endforeach

                    <!-- Total -->
                    <div class="grid grid-cols-4 gap-4 p-4 bg-gradient-to-r from-orange-500/20 to-orange-600/20 rounded-lg border border-orange-400/30 mt-6">
                        <div class="col-span-3 text-right text-white font-bold text-lg">Total:</div>
                        <div class="text-center text-orange-300 font-bold text-lg">
                            {{ number_format($vendorItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }} ETB
                        </div>
                    </div>
                </div>
                <!-- Status Update -->
<div class="border-t border-gray-200 pt-6 mt-6">
    <h4 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        Update Status (applies to your items)
    </h4>

   <form action="{{ route('vendor.orders.updateStatus', $order) }}" method="POST" class="glass-effect rounded-xl p-6">
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
    </div>
</body>
</html>
