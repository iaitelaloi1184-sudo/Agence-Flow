<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ $task->titre }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl bg-white rounded-xl border border-gray-100 p-6 space-y-4">
        <div>
            <p class="text-xs text-gray-400">Campagne</p>
            <p class="text-sm text-gray-900">{{ $task->campaign->nom ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400">Assigné à</p>
            <p class="text-sm text-gray-900">{{ $task->user->name ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400">Description</p>
            <p class="text-sm text-gray-900">{{ $task->description ?? 'Aucune description' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400">Deadline</p>
            <p class="text-sm text-gray-900">{{ $task->deadline ? $task->deadline->format('d/m/Y') : 'Non définie' }}</p>
        </div>

        <div class="flex gap-2 pt-2">
            <a href="{{ route('tasks.edit', $task) }}"
               class="flex-1 text-center border border-gray-200 text-gray-700 text-sm font-medium py-2 rounded-lg hover:bg-gray-50">
                Modifier
            </a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                  onsubmit="return confirm('Supprimer cette tâche ?');" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full border border-red-200 text-red-600 text-sm font-medium py-2 rounded-lg hover:bg-red-50">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>