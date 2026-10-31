
<x-guest-layout>

    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Welcome Back!
        </h1>

        <p class="text-gray-500 mt-2">
            Login to manage your daily tasks
        </p>
    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email Address" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">

            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Remember Me
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm text-blue-600 hover:underline"
                    href="{{ route('password.request') }}"
                >
                    Forgot Password?
                </a>
            @endif

        </div>

        <!-- Login Button -->
        <div class="mt-6">

            <x-primary-button class="w-full justify-center">
                Login
            </x-primary-button>

        </div>

        <!-- Register Link -->
        <div class="text-center mt-5">

            <p class="text-sm text-gray-600">
                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="text-blue-600 font-semibold hover:underline"
                >
                    Register
                </a>
            </p>

        </div>

    </form>

</x-guest-layout>
