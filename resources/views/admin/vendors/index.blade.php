<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Vendor Management | Chaka Shoping</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .vendor-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .vendor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .filter-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .filter-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .filter-btn:hover:before {
            left: 100%;
        }

        .admin-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; top: 20%; width: 10px; height: 10px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; top: 80%; width: 15px; height: 15px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 60%; top: 30%; width: 8px; height: 8px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 80%; top: 70%; width: 12px; height: 12px; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; top: 10%; width: 6px; height: 6px; animation-delay: 3s;"></div>
    </div>

    <!-- Admin Navigation -->
    <nav class="admin-nav sticky top-0 z-50 px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Chaka Shoping Admin</span>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-orange-500 transition-colors">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-orange-500 transition-colors">
                    <i class="fas fa-box mr-2"></i>Products
                </a>
                <a href="{{ route('admin.vendors.index') }}" class="text-orange-500 font-semibold">
                    <i class="fas fa-store mr-2"></i>Vendors
                </a>
                <a href="my/orders" class="text-gray-600 hover:text-orange-500 transition-colors">
                    <i class="fas fa-shopping-cart mr-2"></i>Orders
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
                <div class="flex items-center space-x-3 ml-6 pl-6 border-l border-gray-200">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Admin</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="glass-effect rounded-2xl p-6 mb-6">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">
                    <i class="fas fa-store mr-3 text-orange-500"></i>Vendor Management
                </h1>
                <p class="text-gray-600">Manage and review vendor applications and accounts</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('admin.vendors.index', ['filter' => 'pending']) }}"
                   class="filter-btn px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-xl font-semibold hover:from-yellow-600 hover:to-orange-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-clock mr-2"></i>Pending Approval
                </a>
                <a href="{{ route('admin.vendors.index', ['filter' => 'approved']) }}"
                   class="filter-btn px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-semibold hover:from-green-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-check-circle mr-2"></i>Approved
                </a>
                <a href="{{ route('admin.vendors.index', ['filter' => 'all']) }}"
                   class="filter-btn px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-list mr-2"></i>All Vendors
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Vendors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($vendors as $v)
            <div class="vendor-card rounded-2xl p-6 shadow-lg border border-gray-100">
                <!-- Vendor Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-store text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $v->business_name }}</h3>
                            <p class="text-sm text-gray-500">ID: #{{ $v->id }}</p>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="flex flex-col items-end">
                        @if($v->is_approved)
                            <span class="status-badge px-3 py-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-semibold rounded-full">
                                <i class="fas fa-check mr-1"></i>Approved
                            </span>
                        @else
                            <span class="status-badge px-3 py-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-semibold rounded-full">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @endif
                        <span class="text-xs text-gray-500 mt-1">{{ $v->status }}</span>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-50 rounded-xl p-4 mb-4">
                    <h4 class="font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-orange-500"></i>Contact Information
                    </h4>
                    <div class="space-y-1">
                        <p class="text-gray-800 font-medium">{{ $v->user->name ?? '—' }}</p>
                        <p class="text-gray-600 text-sm">
                            <i class="fas fa-envelope mr-2"></i>{{ $v->user->email ?? 'No email provided' }}
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <!-- Actions -->
<div class="flex space-x-2">
    <a href="{{ route('admin.vendors.show', $v) }}"
       class="flex-1 bg-gradient-to-r from-blue-500 to-purple-500 text-white py-2 px-4 rounded-xl font-semibold text-center hover:from-blue-600 hover:to-purple-600 transform hover:scale-105 transition-all duration-300 shadow-md">
        <i class="fas fa-eye mr-2"></i>View Details
    </a>

    <a href="{{ route('admin.vendors.edit', $v) }}"
       class="flex-1 bg-white border border-gray-200 text-gray-800 py-2 px-4 rounded-xl font-semibold text-center hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-sm">
        <i class="fas fa-edit mr-2"></i>Edit
    </a>
</div>

            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="glass-effect rounded-2xl p-6">
            <div class="flex justify-center">
                {{ $vendors->links() }}
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate vendor cards on scroll
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

            // Observe all vendor cards
            document.querySelectorAll('.vendor-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add click effects to filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Enhanced pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .pagination a {
            background: rgba(255, 255, 255, 0.8);
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .pagination a:hover {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .active span {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            font-weight: 600;
        }
    </style>
</body>
</html>
