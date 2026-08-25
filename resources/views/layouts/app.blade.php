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
                    <div class="px-4 py-2 mb-2" x-data="{ open: false }">
    <button @click="open = !open" class="relative flex items-center gap-3 w-full px-0 py-1 text-gray-300 hover:text-white text-sm">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        Notifications
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute -top-1 left-4 bg-red-600 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.outside="open = false" x-cloak
         class="absolute left-4 mt-2 w-72 bg-white rounded-lg shadow-lg border border-gray-100 z-50 max-h-80 overflow-y-auto">
        @forelse(auth()->user()->notifications->take(10) as $notif)
            <a href="{{ route('tasks.show', $notif->data['task_id']) }}"
               class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 border-b border-gray-50 last:border-0">
                {{ $notif->data['message'] }}
                <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
            </a>
        @empty
            <p class="px-4 py-6 text-sm text-gray-400 text-center">Aucune notification</p>
        @endforelse
    </div>
</div>
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
@role('admin')
    <a href="{{ route('employees.index') }}"
        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('employees.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        Employés
    </a>
@endrole

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