<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AgenceFlow') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-50">

            {{-- Sidebar --}}
            <aside class="w-64 bg-gray-900 text-white flex flex-col">
                <div class="p-6 border-b border-gray-800">
                    <img src="{{ asset('images/logo.png') }}" alt="212Communication" class="h-10 w-auto bg-white rounded p-1">
                </div>

                <nav class="flex-1 px-4 py-6 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('clients.index') }}"

    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('clients.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
    Clients
</a>
<a href="{{ route('campaigns.index') }}"
    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('campaigns.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
    Campagnes
</a>
<a href="{{ route('tasks.index') }}"
    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('tasks.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
    Tâches
</a>

                </nav>

                <div class="p-4 border-t border-gray-800">
                    <div class="flex items-center gap-3 px-2 mb-3">
                        <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-sm font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm text-gray-300 truncate">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800">
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </aside>

            {{-- Main content --}}
            <div class="flex-1 flex flex-col">
                @isset($header)
                    <header class="bg-white border-b border-gray-100">
                        <div class="px-8 py-5">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>