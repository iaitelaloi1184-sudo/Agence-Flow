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

    <div x-data="{
        search: '',
        draggedId: null,
        tasks: {{ $tasks->map(fn($t) => [
            'id' => $t->id,
            'titre' => $t->titre,
            'user' => $t->user->name ?? '—',
            'campagne' => $t->campaign->nom ?? '—',
            'priorite' => $t->priorite,
            'statut' => $t->statut,
            'url' => route('tasks.show', $t),
        ])->toJson() }},
        filtered() {
            return this.tasks.filter(t =>
                t.titre.toLowerCase().includes(this.search.toLowerCase()) ||
                t.user.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        async dropTask(newStatut) {
            const task = this.tasks.find(t => t.id === this.draggedId);
            if (!task || task.statut === newStatut) return;

            const oldStatut = task.statut;
            task.statut = newStatut;

            try {
                const res = await fetch(`/tasks/${task.id}/update-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({ statut: newStatut }),
                });
                if (!res.ok) throw new Error();
            } catch (e) {
                task.statut = oldStatut;
                alert('Erreur : la mise à jour n\'a pas pu être enregistrée.');
            }

            this.draggedId = null;
        }
    }">

        <div class="flex items-center justify-between mb-4 gap-4">
            <input type="text" x-model="search" placeholder="Rechercher une tâche ou un employé..."
                class="w-full max-w-xs px-4 py-2 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">

            <a href="{{ route('tasks.create') }}"
               class="shrink-0 bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
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
                <div class="bg-gray-100 rounded-xl p-3 min-h-[120px]"
                     @dragover.prevent
                     @drop="dropTask('{{ $statutKey }}')">

                    <p class="text-sm font-medium text-gray-500 mb-3 px-1">
                        {{ $label }}
                        <span x-text="'· ' + filtered().filter(t => t.statut === '{{ $statutKey }}').length"></span>
                    </p>

                    <div class="space-y-2">
                        <template x-for="task in filtered().filter(t => t.statut === '{{ $statutKey }}')" :key="task.id">
                            <div draggable="true"
                                 @dragstart="draggedId = task.id"
                                 class="bg-white rounded-lg border border-gray-100 p-3 shadow-sm cursor-move hover:shadow-md transition">
                                <a :href="task.url" class="text-sm text-gray-900 mb-2 block hover:underline" x-text="task.titre"></a>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-2 py-0.5 rounded-full"
                                        :class="{
                                            'bg-red-100 text-red-600': task.priorite === 'haute',
                                            'bg-yellow-100 text-yellow-700': task.priorite === 'moyenne',
                                            'bg-green-100 text-green-700': task.priorite === 'basse'
                                        }"
                                        x-text="task.priorite"></span>
                                    <span class="text-xs text-gray-400" x-text="task.user"></span>
                                </div>
                            </div>
                        </template>

                        <p x-show="filtered().filter(t => t.statut === '{{ $statutKey }}').length === 0"
                           class="text-xs text-gray-400 text-center py-4">Aucune tâche</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>