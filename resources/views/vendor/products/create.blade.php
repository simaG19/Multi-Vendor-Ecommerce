<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - Vendor Panel</title>
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

        .form-field {
            transition: all 0.3s ease;
        }

        .form-field:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.1);
        }

        .gradient-text {
            background: linear-gradient(45deg, #ed8936, #dd6b20);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .file-upload-area {
            border: 2px dashed #ed8936;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            border-color: #dd6b20;
            background: rgba(237, 137, 54, 0.05);
        }

        .form-input {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(237, 137, 54, 0.2);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #ed8936;
            box-shadow: 0 0 0 3px rgba(237, 137, 54, 0.1);
            background: rgba(255, 255, 255, 0.95);
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
                    <a href="{{ route('vendor.dashboard', $vendor) }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('vendor.orders.index', $vendor) }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                    <a href="{{ route('vendor.products.index', $vendor) }}" class="text-orange-600 font-medium border-b-2 border-orange-600 pb-1">
                        <i class="fas fa-box mr-2"></i>Products
                    </a>
                    {{-- <a href="{{ route('vendor.analytics', $vendor) }}" class="text-gray-700 hover:text-orange-600 transition-colors duration-200 font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Analytics
                    </a> --}}
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
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <!-- Fixed back link to include vendor parameter -->
                <a href="{{ route('vendor.products.index', $vendor) }}" class="text-orange-600 hover:text-orange-700 mr-4">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="text-3xl font-bold gradient-text">Create New Product</h1>
            </div>
            <p class="text-gray-600">Add a new product to your inventory</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="glass-effect rounded-lg p-6 mb-6 border-l-4 border-red-500">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
                        <ul class="list-disc list-inside text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Create Product Form -->
        <div class="glass-effect rounded-2xl p-8">
            <!-- Fixed form action to include vendor parameter -->
      <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('POST')

    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

    <!-- Product Name -->
    <div class="form-field">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-tag mr-2 text-orange-600"></i>Product Name *
        </label>
        <input type="text"
               name="name"
               value="{{ old('name') }}"
               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
               placeholder="Enter product name"
               required>
    </div>

    <!-- Product Images (3 required) -->
    <div class="form-field">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-images mr-2 text-orange-600"></i>Product Images (3 Required)
        </label>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <!-- Image 1 -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Image 1 *</label>
                <input type="file"
                       name="img_1"
                       accept="image/*"
                       required
                       class="block w-full text-sm text-gray-700" />
            </div>

            <!-- Image 2 -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Image 2 *</label>
                <input type="file"
                       name="img_2"
                       accept="image/*"
                       required
                       class="block w-full text-sm text-gray-700" />
            </div>

            <!-- Image 3 -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Image 3 *</label>
                <input type="file"
                       name="img_3"
                       accept="image/*"
                       required
                       class="block w-full text-sm text-gray-700" />
            </div>

        </div>

        <p class="mt-2 text-sm text-gray-600">
            Upload exactly 3 product images. These will appear in the gallery/swiper.
        </p>
    </div>


                <!-- SKU and Brand Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-barcode mr-2 text-orange-600"></i>SKU
                        </label>
                        <input type="text"
                               name="sku"
                               value="{{ old('sku') }}"
                               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                               placeholder="Product SKU">
                    </div>

                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-certificate mr-2 text-orange-600"></i>Brand
                        </label>
                        <input type="text"
                               name="brand"
                               value="{{ old('brand') }}"
                               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                               placeholder="Brand name">
                    </div>
                </div>

                <!-- Category and Discount Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list mr-2 text-orange-600"></i>Category
                        </label>
                        <select name="category_id" class="form-input w-full px-4 py-3 rounded-lg focus:outline-none">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-percent mr-2 text-orange-600"></i>Discount (%)
                        </label>
                        <input type="number"
                               name="discount_percent"
                               min="0"
                               max="100"
                               value="{{ old('discount_percent', 0) }}"
                               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                               placeholder="0">
                    </div>
                </div>

                <!-- Price and Stock Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-dollar-sign mr-2 text-orange-600"></i>Price (ETB) *
                        </label>
                        <input type="number"
                               step="0.01"
                               name="price"
                               value="{{ old('price') }}"
                               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                               placeholder="0.00"
                               required>
                    </div>

                    <div class="form-field">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-boxes mr-2 text-orange-600"></i>Stock Quantity *
                        </label>
                        <input type="number"
                               name="stock"
                               value="{{ old('stock', 0) }}"
                               class="form-input w-full px-4 py-3 rounded-lg focus:outline-none"
                               placeholder="0"
                               required>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-field">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2 text-orange-600"></i>Description
                    </label>
                    <textarea name="description"
                              rows="4"
                              class="form-input w-full px-4 py-3 rounded-lg focus:outline-none resize-none"
                              placeholder="Describe your product...">{{ old('description') }}</textarea>
                </div>

                <!-- Active Status -->
                <div class="form-field">
                    <div class="flex items-center">
                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               id="is_active"
                               class="w-5 h-5 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">
                            <i class="fas fa-toggle-on mr-2 text-orange-600"></i>Product is Active
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 ml-8">Active products will be visible to customers</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <!-- Fixed cancel link to include vendor parameter -->
                    <a href="{{ route('vendor.products.index', $vendor) }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload preview
            const fileInput = document.getElementById('imageUpload');
            const uploadArea = document.querySelector('.file-upload-area');

            fileInput.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    uploadArea.innerHTML = `
                        <i class="fas fa-check-circle text-4xl text-green-600 mb-4"></i>
                        <p class="text-green-700 font-medium mb-2">${files.length} image(s) selected</p>
                        <p class="text-sm text-gray-500">Click to change images</p>
                    `;
                    uploadArea.classList.add('border-green-500');
                    uploadArea.classList.remove('border-orange-500');
                }
            });

            // Form field animations
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Real-time price formatting
            const priceInput = document.querySelector('input[name="price"]');
            if (priceInput) {
                priceInput.addEventListener('input', function() {
                    const value = parseFloat(this.value);
                    if (!isNaN(value)) {
                        this.style.color = '#ed8936';
                        this.style.fontWeight = '600';
                    } else {
                        this.style.color = '';
                        this.style.fontWeight = '';
                    }
                });
            }
        });
    </script>
</body>
</html>
