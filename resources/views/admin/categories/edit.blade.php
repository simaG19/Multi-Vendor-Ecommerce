<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin - Chaka Shoping </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #ed8936;
            box-shadow: 0 0 0 3px rgba(237, 137, 54, 0.1);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .checkbox-wrapper:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(237, 137, 54, 0.3);
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            accent-color: #ed8936;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 6px;
        }

        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .logo-text {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; top: 20%; width: 4px; height: 4px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; top: 80%; width: 6px; height: 6px; animation-delay: 1s;"></div>
        <div class="particle" style="left: 60%; top: 30%; width: 3px; height: 3px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 80%; top: 70%; width: 5px; height: 5px; animation-delay: 3s;"></div>
        <div class="particle" style="left: 30%; top: 10%; width: 4px; height: 4px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 70%; top: 90%; width: 6px; height: 6px; animation-delay: 5s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold logo-text">Chaka Shoping  Admin</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-chart-bar mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="fas fa-box mr-2"></i>Products
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="nav-link">
                        <i class="fas fa-store mr-2"></i>Vendors
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                        <i class="fas fa-tags mr-2"></i>Categories
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="text-white text-sm">
                        <i class="fas fa-user-circle mr-2"></i>Admin
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Edit Category</h1>
                <p class="text-white/80">Update category information and settings.</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary text-white px-6 py-3 rounded-lg font-semibold flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
        <div class="glass-effect border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle text-red-400 mr-2"></i>
                <h3 class="text-red-400 font-semibold">Please fix the following errors:</h3>
            </div>
            <ul class="text-red-300 space-y-1">
                @foreach($errors->all() as $error)
                <li class="flex items-center">
                    <i class="fas fa-circle text-xs mr-2"></i>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Edit Form -->
        <div class="glass-effect rounded-xl p-8">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Category Name -->
                <div>
                    <label for="name" class="block text-white font-semibold mb-3">
                        <i class="fas fa-tag mr-2 text-orange-500"></i>
                        Category Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="form-input w-full px-4 py-3 rounded-lg"
                        placeholder="Enter category name..."
                        required
                    >
                    <p class="text-white/60 text-sm mt-2">Choose a clear, descriptive name for your category.</p>
                </div>

                <!-- Active Status -->
                <div>
                    <label class="block text-white font-semibold mb-3">
                        <i class="fas fa-toggle-on mr-2 text-orange-500"></i>
                        Status
                    </label>
                    <label class="checkbox-wrapper">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="checkbox-input"
                            {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                        >
                        <span class="text-white">Active - Category will be visible to customers</span>
                    </label>
                    <p class="text-white/60 text-sm mt-2">Inactive categories won't appear in product listings or navigation.</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-white/10">
                    <a href="{{ route('admin.categories.index') }}" class="btn-secondary text-white px-6 py-3 rounded-lg font-semibold">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Update Category</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.glass-effect');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
