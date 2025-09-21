<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category - Admin - Nana </title>
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

        .form-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(237, 137, 54, 0.5);
            box-shadow: 0 0 0 3px rgba(237, 137, 54, 0.1);
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
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
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .checkbox-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-input {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
            margin-right: 12px;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox-input:checked {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            border-color: #ed8936;
        }

        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
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
                        <span class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Nana Admin</span>
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Create Category</h1>
                <p class="text-white/80">Add a new product category to your marketplace.</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary text-white px-6 py-3 rounded-lg font-semibold flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
        <div class="glass-effect border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                <div>
                    <h3 class="text-red-400 font-semibold mb-2">Please fix the following errors:</h3>
                    <ul class="text-white/90 space-y-1">
                        @foreach($errors->all() as $error)
                        <li class="flex items-center">
                            <i class="fas fa-circle text-red-400 text-xs mr-2"></i>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Create Form -->
        <div class="glass-effect rounded-xl p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

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
                        value="{{ old('name') }}"
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
                            {{ old('is_active', true) ? 'checked' : '' }}
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
                        <i class="fas fa-save"></i>
                        <span>Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
