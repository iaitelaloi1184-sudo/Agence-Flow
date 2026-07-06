<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Tâches') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">{{ $tasks->count() }} tâche(s)</p>
        <a href="{{ route('tasks.create') }}"
           class="bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Nouvelle tâche
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        @php
            $colonnes = [
                'a_faire' => 'À faire',
                'en_cours' => 'En cours',
                'en_revision' => 'En révision',
                'termine' => 'Terminé',
            ];
        @endphp

        @foreach ($colonnes as $statutKey => $label)
            <div class="bg-gray-100 rounded-xl p-3">
                <p class="text-sm font-medium text-gray-500 mb-3 px-1">
                    {{ $label }} · {{ $tasks->where('statut', $statutKey)->count() }}
                </p>

                <div class="space-y-2">
                    @forelse ($tasks->where('statut', $statutKey) as $task)
                        <a href="{{ route('tasks.show', $task) }}" class="block bg-white rounded-lg border border-gray-100 p-3 shadow-sm hover:shadow-md transition">
                            <p class="text-sm text-gray-900 mb-2">{{ $task->titre }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs px-2 py-0.5 rounded-full
                                    @if($task->priorite === 'haute') bg-red-100 text-red-600
                                    @elseif($task->priorite === 'moyenne') bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ $task->priorite }}
                                </span>
                                <span class="text-xs text-gray-400">{{ $task->user->name ?? '' }}</span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">Aucune tâche</p>
                    @endforelse
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>