<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ $task->titre }}
            </h2>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 max-w-2xl bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl space-y-6">

        <div class="bg-white rounded-xl border border-gray-100 p-6 space-y-4">
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

        {{-- Commentaires --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">
                Commentaires ({{ $task->comments->count() }})
            </h3>

            <div class="space-y-4 mb-5">
                @forelse ($task->comments->sortByDesc('created_at') as $comment)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-900 text-white text-xs font-bold flex items-center justify-center shrink-0">
                            {{ substr($comment->user->name ?? '?', 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-900">{{ $comment->user->name ?? 'Utilisateur' }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-700 mt-0.5">{{ $comment->contenu }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">Aucun commentaire pour le moment</p>
                @endforelse
            </div>

            <form method="POST" action="{{ route('tasks.comments.store', $task) }}" class="flex gap-2">
                @csrf
                <input type="text" name="contenu" placeholder="Ajouter un commentaire..." required
                    class="flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">
                <button type="submit"
                    class="bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Envoyer
                </button>
            </form>
            @error('contenu') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

    </div>
</x-app-layout>