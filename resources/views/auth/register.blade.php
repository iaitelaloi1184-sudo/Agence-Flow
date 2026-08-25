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