<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories - Chaka Shoping </title>
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
            background: rgba(237, 137, 54, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(237, 137, 54, 0.3);
        }

        .btn-secondary {
            background: rgba(59, 130, 246, 0.8);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(59, 130, 246, 1);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.8);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 1);
            transform: translateY(-2px);
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
                        {{-- <span class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Chaka Shoping Admin</span> --}}
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-box mr-2"></i>Products
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-store mr-2"></i>Vendors
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="text-white hover:text-orange-500 transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="text-orange-500 font-semibold">
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

                    {{-- <div class="flex items-center space-x-3 ml-6 pl-6 border-l border-white/20">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-white font-medium">Admin</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Categories Management</h1>
                <p class="text-white/80">Manage product categories and their settings.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Category</span>
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="glass-effect border-l-4 border-green-500 p-4 mb-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-400 mr-3"></i>
                <span class="text-white">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($categories as $cat)
            <div class="category-card glass-effect rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tag text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ $cat->name }}</h3>
                            <p class="text-white/60 text-sm">ID: {{ $cat->id }}</p>
                        </div>
                    </div>
                    <span class="status-badge {{ $cat->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $cat->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="flex items-center space-x-3 mt-6">
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn-secondary text-white px-4 py-2 rounded-lg font-medium flex items-center space-x-2 flex-1 justify-center">
                        <i class="fas fa-edit text-sm"></i>
                        <span>Edit</span>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger text-white px-4 py-2 rounded-lg font-medium flex items-center space-x-2 w-full justify-center">
                            <i class="fas fa-trash text-sm"></i>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
        <div class="glass-effect rounded-xl p-6">
            <div class="flex items-center justify-center">
                {{ $categories->links() }}
            </div>
        </div>
        @endif
    </div>

    <style>
        /* Custom pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            space-x: 2;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            margin: 0 4px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
        }

        .pagination a:hover {
            background: rgba(237, 137, 54, 0.8);
            transform: translateY(-2px);
        }

        .pagination .active span {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            color: white;
        }

        .pagination .disabled span {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.3);
        }
    </style>
</body>
</html>
