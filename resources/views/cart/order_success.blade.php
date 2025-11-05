<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Chaka Shoping</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: linear-gradient(45deg, #ed8936, #dd6b20);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { width: 8px; height: 8px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 12px; height: 12px; left: 20%; animation-delay: 1s; }
        .particle:nth-child(3) { width: 6px; height: 6px; left: 30%; animation-delay: 2s; }
        .particle:nth-child(4) { width: 10px; height: 10px; left: 40%; animation-delay: 3s; }
        .particle:nth-child(5) { width: 8px; height: 8px; left: 50%; animation-delay: 4s; }
        .particle:nth-child(6) { width: 14px; height: 14px; left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { width: 6px; height: 6px; left: 70%; animation-delay: 1.5s; }
        .particle:nth-child(8) { width: 10px; height: 10px; left: 80%; animation-delay: 2.5s; }
        .particle:nth-child(9) { width: 8px; height: 8px; left: 90%; animation-delay: 3.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .success-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .order-number-card {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            border: 2px solid #fb923c;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.3);
        }

        .btn-ghost {
            border: 2px solid #ed8936;
            color: #ed8936;
            transition: all 0.3s ease;
        }

        .btn-ghost:hover {
            background: #ed8936;
            color: white;
            transform: translateY(-2px);
        }

        .celebration-icon {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .checkmark {
            animation: checkmark 0.6s ease-in-out;
        }

        @keyframes checkmark {
            0% { transform: scale(0) rotate(45deg); }
            50% { transform: scale(1.2) rotate(45deg); }
            100% { transform: scale(1) rotate(45deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-orange-100 min-h-screen">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-orange-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-2 rounded-lg">
                        <i class="fas fa-shopping-bag text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-orange-600 to-orange-700 bg-clip-text text-transparent">Chaka Shoping</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Products</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Vendors</a>
                    <a href="#" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">Categories</a>
                </div>

                <!-- Cart -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 sm:py-12">
        <div class="max-w-2xl mx-auto">
            <!-- Success Card -->
            <div class="success-card rounded-2xl shadow-2xl p-6 sm:p-8 mb-8 relative overflow-hidden">
                <!-- Success Icon -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                        <div class="checkmark w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="celebration-icon text-4xl mb-2">🎉</div>
                </div>

                <!-- Success Message -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">Thank you — order placed!</h1>
                    <p class="text-gray-600 text-base sm:text-lg">Your order has been received successfully. Save this Order ID to check status:</p>
                </div>

                <!-- Order Number -->
                <div class="order-number-card rounded-xl p-6 mb-8 text-center">
                    <div class="mb-2">
                        <i class="fas fa-receipt text-orange-600 text-2xl mb-3"></i>
                    </div>
                    <h3 class="font-mono text-xl sm:text-2xl font-bold text-orange-800 mb-2">{{ $order->order_number }}</h3>
                    <p class="text-sm text-orange-700">We sent a confirmation to the provided phone number (if any).</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('order.public.show', $order->order_number) }}"
                       class="btn-primary text-white px-6 py-3 rounded-lg font-semibold text-center inline-flex items-center justify-center space-x-2 shadow-lg">
                        <i class="fas fa-eye"></i>
                        <span>View Order Details</span>
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="btn-ghost px-6 py-3 rounded-lg font-semibold text-center inline-flex items-center justify-center space-x-2">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 shadow-lg">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="flex flex-col items-center space-y-2">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-truck text-blue-600"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800">Fast Delivery</h4>
                        <p class="text-sm text-gray-600">Quick and secure shipping</p>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-green-600"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800">Secure Payment</h4>
                        <p class="text-sm text-gray-600">Your payment is protected</p>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-headset text-purple-600"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800">24/7 Support</h4>
                        <p class="text-sm text-gray-600">We're here to help</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-sm border-t border-orange-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-2 rounded-lg">
                        <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-orange-600 to-orange-700 bg-clip-text text-transparent">Chaka Shoping</span>
                </div>
                <p class="text-gray-600">&copy; 2024 Chaka Shoping Marketplace. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
