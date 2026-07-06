<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">

        {{-- Cartes statistiques --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <p class="text-sm text-gray-400 mb-1">Clients</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <p class="text-sm text-gray-400 mb-1">Campagnes en cours</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['projets_en_cours'] }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <p class="text-sm text-gray-400 mb-1">Tâches terminées</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['taches_terminees'] }}</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <p class="text-sm text-gray-400 mb-1">Tâches en retard</p>
                <p class="text-3xl font-bold text-red-600">{{ $stats['taches_retard'] }}</p>
            </div>
        </div>

        {{-- Tâches urgentes --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Tâches urgentes</h3>

            @forelse ($taches_urgentes as $task)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $task->titre }}</p>
                        <p class="text-xs text-gray-400">{{ $task->campaign->nom ?? '—' }} · {{ $task->user->name ?? '—' }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        @if ($task->deadline)
                            <span class="text-xs text-gray-400">{{ $task->deadline->format('d/m/Y') }}</span>
                        @endif
                        <span class="text-xs px-2 py-0.5 rounded-full
                            @if($task->priorite === 'haute') bg-red-100 text-red-600
                            @elseif($task->priorite === 'moyenne') bg-yellow-100 text-yellow-700
                            @else bg-green-100 text-green-700 @endif">
                            {{ $task->priorite }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-sm text-gray-400 text-center py-8">
                    Aucune tâche urgente pour le moment
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
