<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chaka Shoping </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background: rgba(237, 137, 54, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .progress-bar {
            height: 8px;
            background: rgba(255,255,255,0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ed8936, #dd6b20);
            border-radius: 4px;
            animation: progressFill 2s ease-out;
        }

        @keyframes progressFill {
            from { width: 0%; }
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle w-4 h-4" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
        <div class="particle w-6 h-6" style="left: 20%; top: 80%; animation-delay: 1s;"></div>
        <div class="particle w-3 h-3" style="left: 60%; top: 30%; animation-delay: 2s;"></div>
        <div class="particle w-5 h-5" style="left: 80%; top: 70%; animation-delay: 3s;"></div>
        <div class="particle w-4 h-4" style="left: 30%; top: 10%; animation-delay: 4s;"></div>
        <div class="particle w-6 h-6" style="left: 70%; top: 90%; animation-delay: 5s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Chaka Shoping Admin</span>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="text-orange-500 font-semibold">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-box mr-2"></i>Products
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-store mr-2"></i>Vendors
                    </a>
                    <a href="my/orders" class="text-white hover:text-orange-500 transition-colors">
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

                    <div class="flex items-center space-x-3 ml-6 pl-6 border-l border-white/20">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-white font-medium">Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-white/80">Welcome back! Here's what's happening with your marketplace.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Users Card -->
            <div class="stat-card glass-effect rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-500/20 rounded-lg">
                        <i class="fas fa-users text-2xl text-blue-400"></i>
                    </div>
                    <span class="text-green-400 text-sm font-medium">+12%</span>
                </div>
                <h3 class="text-white/80 text-sm font-medium mb-1">Total Users</h3>
                <p class="text-3xl font-bold text-white mb-2">{{ $usersCount }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 75%;"></div>
                </div>
            </div>

            <!-- Vendors Card -->
            <div class="stat-card glass-effect rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-500/20 rounded-lg">
                        <i class="fas fa-store text-2xl text-orange-400"></i>
                    </div>
                    <span class="text-green-400 text-sm font-medium">+8%</span>
                </div>
                <h3 class="text-white/80 text-sm font-medium mb-1">Active Vendors</h3>
                <p class="text-3xl font-bold text-white mb-2">{{ $vendorsCount }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 60%;"></div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="stat-card glass-effect rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-500/20 rounded-lg">
                        <i class="fas fa-box text-2xl text-green-400"></i>
                    </div>
                    <span class="text-green-400 text-sm font-medium">+15%</span>
                </div>
                <h3 class="text-white/80 text-sm font-medium mb-1">Total Products</h3>
                <p class="text-3xl font-bold text-white mb-2">{{ $productsCount }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 85%;"></div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="stat-card glass-effect rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-500/20 rounded-lg">
                        <i class="fas fa-shopping-cart text-2xl text-purple-400"></i>
                    </div>
                    <span class="text-green-400 text-sm font-medium">+23%</span>
                </div>
                <h3 class="text-white/80 text-sm font-medium mb-1">Total Orders</h3>
                <p class="text-3xl font-bold text-white mb-2">{{ $ordersCount }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 90%;"></div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Sales Chart -->
            <div class="glass-effect rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Sales Overview</h3>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="glass-effect rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Order Status</h3>
                <div class="chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Chart -->
            <div class="glass-effect rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Monthly Revenue</h3>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="glass-effect rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Top Categories</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-white/80">Electronics</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-20 h-2 bg-white/20 rounded-full">
                                <div class="w-16 h-2 bg-orange-500 rounded-full"></div>
                            </div>
                            <span class="text-white text-sm">80%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/80">Fashion</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-20 h-2 bg-white/20 rounded-full">
                                <div class="w-12 h-2 bg-blue-500 rounded-full"></div>
                            </div>
                            <span class="text-white text-sm">60%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/80">Food</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-20 h-2 bg-white/20 rounded-full">
                                <div class="w-14 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="text-white text-sm">70%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/80">Books</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-20 h-2 bg-white/20 rounded-full">
                                <div class="w-8 h-2 bg-purple-500 rounded-full"></div>
                            </div>
                            <span class="text-white text-sm">40%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="glass-effect rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full pulse"></div>
                        <span class="text-white/80 text-sm">New order received</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full pulse"></div>
                        <span class="text-white/80 text-sm">Vendor approved</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-orange-500 rounded-full pulse"></div>
                        <span class="text-white/80 text-sm">Product updated</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full pulse"></div>
                        <span class="text-white/80 text-sm">User registered</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [12000, 19000, 15000, 25000, 22000, 30000],
                    borderColor: '#ed8936',
                    backgroundColor: 'rgba(237, 137, 54, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(255,255,255,0.8)'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgba(255,255,255,0.8)'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    }
                }
            }
        });

        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Shipped', 'Delivered'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: [
                        '#fbbf24',
                        '#3b82f6',
                        '#8b5cf6',
                        '#10b981'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Revenue',
                    data: [50000, 75000, 60000, 90000, 85000],
                    backgroundColor: 'rgba(237, 137, 54, 0.8)',
                    borderColor: '#ed8936',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(255,255,255,0.8)'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgba(255,255,255,0.8)'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
