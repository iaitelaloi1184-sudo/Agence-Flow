<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8">
        <div class="w-full max-w-md">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

                {{-- Logo --}}
                <div class="mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="212Communication" class="h-24 w-auto">
                </div>

                <p class="text-sm text-gray-400 mb-1">Create your account</p>
                <h1 class="text-2xl font-bold text-gray-900 mb-8">Get started</h1>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="Full name"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Email address"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <input id="password" type="password" name="password" required
                            placeholder="Password"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Confirm password"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-gray-900 hover:bg-red-600 text-white font-medium py-3 rounded-lg transition">
                        Sign up
                    </button>

                    {{-- Google Sign in --}}
                    <button type="button"
                        class="w-full flex items-center justify-center gap-2 border border-gray-200 text-gray-700 font-medium py-3 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.9 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.5 6.1 29.5 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z"/>
                            <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 16 19 13 24 13c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.5 6.1 29.5 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
                            <path fill="#4CAF50" d="M24 44c5.2 0 9.9-2 13.4-5.2l-6.2-5.2C29.2 35.5 26.7 36 24 36c-5.3 0-9.7-3.4-11.3-8.1l-6.5 5C9.6 39.6 16.3 44 24 44z"/>
                            <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.1 5.6l6.2 5.2C40.5 36.9 44 31.1 44 24c0-1.3-.1-2.7-.4-3.5z"/>
                        </svg>
                        Sign up with Google
                    </button>

                    {{-- Login link --}}
                    <p class="text-center text-sm text-gray-500 pt-2">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-red-600 font-medium hover:underline">
                            Sign in
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>