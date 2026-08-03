<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('campaigns.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ $campaign->nom }}
            </h2>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Infos campagne --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-sm font-semibold text-gray-900 mb-2">Informations</h3>

            <div>
                <p class="text-xs text-gray-400">Client</p>
                <p class="text-sm text-gray-900">{{ $campaign->client->nom ?? '—' }}</p>
            </div>

            <div>
                <p class="text-xs text-gray-400">Période</p>
                <p class="text-sm text-gray-900">
                    {{ $campaign->date_debut->format('d/m/Y') }} → {{ $campaign->date_fin->format('d/m/Y') }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-400">Statut</p>
                <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-full
                    @if($campaign->statut === 'en_cours') bg-blue-100 text-blue-700
                    @elseif($campaign->statut === 'termine') bg-gray-100 text-gray-600
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ $campaign->statut }}
                </span>
            </div>

            <div>
                <p class="text-xs text-gray-400">Objectifs</p>
                <p class="text-sm text-gray-900">{{ $campaign->objectifs ?? 'Aucun objectif défini' }}</p>
            </div>

            <a href="{{ route('campaigns.pdf', $campaign) }}"
   class="block w-full text-center border border-gray-200 text-gray-700 text-sm font-medium py-2 rounded-lg hover:bg-gray-50 mb-2">
    📄 Exporter en PDF
</a>
<div class="flex gap-2 pt-2">
    @role('admin')
        <a href="{{ route('campaigns.edit', $campaign) }}"
           class="flex-1 text-center border border-gray-200 text-gray-700 text-sm font-medium py-2 rounded-lg hover:bg-gray-50">
            Modifier
        </a>
    @endrole
    @role('admin')
        <form method="POST" action="{{ route('campaigns.destroy', $campaign) }}"
              onsubmit="return confirm('Supprimer cette campagne ?');" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full border border-red-200 text-red-600 text-sm font-medium py-2 rounded-lg hover:bg-red-50">
                Supprimer
            </button>
        </form>
    @endrole
</div>
        </div>

        {{-- Tâches liées --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-900">Tâches liées ({{ $campaign->tasks->count() }})</h3>
                @role('admin')
                    <a href="{{ route('tasks.create') }}" class="text-sm text-red-600 hover:underline">+ Ajouter une tâche</a>
                @endrole
            </div>

            <div class="space-y-3">
                @forelse ($campaign->tasks as $task)
                    <a href="{{ route('tasks.show', $task) }}" class="flex items-center justify-between border border-gray-100 rounded-lg p-4 hover:bg-gray-50">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $task->titre }}</p>
                            <p class="text-xs text-gray-400">{{ $task->user->name ?? '—' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs px-2 py-0.5 rounded-full
                                @if($task->priorite === 'haute') bg-red-100 text-red-600
                                @elseif($task->priorite === 'moyenne') bg-yellow-100 text-yellow-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $task->priorite }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $task->statut }}</span>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-400 text-center py-8">Aucune tâche liée à cette campagne</p>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>