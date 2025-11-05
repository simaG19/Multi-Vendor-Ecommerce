<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Enhanced login form with orange branding and modern ecommerce design -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <!-- Added Chaka Shoping branding header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome to Chaka Shoping</h2>
            <p class="text-gray-600">Sign in to your account to continue shopping</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold mb-2" />
                <x-text-input id="email"
                    class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 bg-gray-50 focus:bg-white"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold mb-2" />
                <x-text-input id="password"
                    class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 bg-gray-50 focus:bg-white"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500 focus:ring-2"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    {{-- <a class="text-sm text-orange-600 hover:text-orange-700 font-medium transition-colors duration-200"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a> --}}
                @endif
            </div>

            <!-- Enhanced primary button with orange gradient -->
            <div class="pt-4">
                <button type="submit">sign in
                </button>
            </div>
        </form>

        <!-- Added registration link for better UX -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                {{-- Don't have an account?
                <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-700 font-medium transition-colors duration-200">
                    Create one here
                </a> --}}
            </p>
        </div>
    </div>
</x-guest-layout>
