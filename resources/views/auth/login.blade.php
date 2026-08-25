<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

                {{-- Logo --}}
                <div class="mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="212Communication" class="h-16 w-auto">
                </div>

                <p class="text-sm text-gray-400 mb-1">Please enter your details</p>
                <h1 class="text-2xl font-bold text-gray-900 mb-8">Welcome back</h1>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

                    {{-- Remember + Forgot password --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-red-600 focus:ring-red-600">
                            Remember for 30 days
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-gray-900 hover:underline font-medium">
                                Forgot password
                            </a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-gray-900 hover:bg-red-600 text-white font-medium py-3 rounded-lg transition">
                        Sign in
                    </button>

                    {{-- Google Sign in --}}
                    
                    {{-- Register link --}}
                    
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>