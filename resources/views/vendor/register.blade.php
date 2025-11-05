<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vendor Registration - Chaka Shoping </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            /* REMOVED overflow-hidden so page can scroll */
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            position: relative;
            z-index: 40; /* ensure above floating particles */
        }

        /* Floating particles should not block clicks */
        .floating-particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            pointer-events: none; /* important: don't block clicks */
            z-index: 10;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .form-input {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(5px);
            transition: all 0.25s ease;
            color: white;
        }

        .form-input::placeholder { color: rgba(255,255,255,0.6); }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(237, 137, 54, 0.7);
            box-shadow: 0 0 20px rgba(237, 137, 54, 0.18);
            outline: none;
        }

        .success-message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .submit-btn {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            transition: all 0.25s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.32);
        }

        /* small screens: make background particles less obtrusive */
        @media (max-width: 640px) {
            .floating-particle { opacity: 0.5; }
        }
    </style>
</head>
<body class="relative">
    <!-- Floating Background Particles -->
    <div class="floating-particle w-20 h-20 top-10 left-10 animation-delay-0"></div>
    <div class="floating-particle w-16 h-16 top-20 right-20 animation-delay-1000"></div>
    <div class="floating-particle w-12 h-12 top-40 left-1/4 animation-delay-2000"></div>
    <div class="floating-particle w-24 h-24 bottom-20 right-10 animation-delay-3000"></div>
    <div class="floating-particle w-14 h-14 bottom-40 left-20 animation-delay-4000"></div>

    <!-- Header with Login Link -->
    <div class="relative z-30 p-6">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM10 18V8l5 4v6h-2v-4a1 1 0 00-1-1H8a1 1 0 00-1 1v4H5v-6l5-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white">Chaka Shoping </span>
            </div>
            <a href="{{ route('login') }}" class="glass-effect px-6 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                Login
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-30 flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-2xl">
            <!-- Success Message -->
            @if(session('success'))
            <div class="success-message glass-effect rounded-2xl p-8 mb-8 text-center text-white">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Registration Submitted Successfully!</h3>
                <p class="text-lg mb-2">{{ session('success') }}</p>
                <div class="bg-white bg-opacity-20 rounded-lg p-4 mt-6">
                    <p class="text-sm font-medium">📋 What happens next?</p>
                    <p class="text-sm mt-2">Our admin team will review and approve your account within <strong>30 minutes</strong>. Once approved, you can login and start selling on Chaka Shoping !</p>
                </div>
                <a href="{{ route('login') }}" class="inline-block mt-6 px-8 py-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all duration-300">
                    Go to Login
                </a>
            </div>
            @else
            <!-- Registration Form (made scrollable if taller than viewport) -->
            <div class="glass-effect rounded-2xl p-8 shadow-2xl max-h-[85vh] overflow-auto">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Become a Vendor</h1>
                    <p class="text-white text-opacity-80">Join Chaka Shoping  marketplace and start selling your products</p>
                </div>

                <!-- Error Messages -->
                @if($errors->any())
                <div class="bg-red-500 bg-opacity-20 border border-red-400 border-opacity-30 rounded-lg p-4 mb-6">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-red-300 font-medium">Please fix the following errors:</span>
                    </div>
                    <ul class="text-red-200 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('vendor.register.store') }}" class="space-y-6" novalidate>
                    @csrf

                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white border-opacity-20 pb-2">Personal Information</h3>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="contact_name">Contact Name *</label>
                            <input id="contact_name" type="text" name="contact_name" value="{{ old('contact_name') }}" required
                                   class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none"
                                   placeholder="Enter your full name" />
                        </div>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="email">Email Address *</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none"
                                   placeholder="Enter your email address" />
                        </div>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="password">Password *</label>
                            <input id="password" type="password" name="password" autocomplete="new-password" required
                                   class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none"
                                   placeholder="Create a secure password" />
                        </div>
                    </div>

                    <!-- Business Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white border-opacity-20 pb-2">Business Information</h3>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="business_name">Business Name *</label>
                            <input id="business_name" type="text" name="business_name" value="{{ old('business_name') }}" required
                                   class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none"
                                   placeholder="Enter your business name" />
                        </div>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="tin_number">TIN Number</label>
                            <input id="tin_number" type="text" name="tin_number" value="{{ old('tin_number') }}"
                                   class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none"
                                   placeholder="Enter your TIN number (optional)" />
                        </div>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2" for="address">Business Address</label>
                            <textarea id="address" name="address" rows="3"
                                      class="form-input w-full px-4 py-3 rounded-lg placeholder-white placeholder-opacity-60 focus:outline-none resize-y"
                                      placeholder="Enter your business address">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn w-full py-4 rounded-lg text-white font-semibold text-lg shadow-lg">
                        Submit Registration
                    </button>
                </form>

                <div class="text-center mt-6">
                    <p class="text-white text-opacity-60 text-sm">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-orange-300 hover:text-orange-200 font-medium">Login here</a>
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Add staggered animation delays to particles
        document.querySelectorAll('.floating-particle').forEach((particle, index) => {
            particle.style.animationDelay = `${index * 400}ms`;
        });

        // Form submission animation
        document.querySelector('form')?.addEventListener('submit', function() {
            const button = this.querySelector('button[type="submit"]');
            if (!button) return;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
            button.disabled = true;
        });
    </script>
</body>
</html>
