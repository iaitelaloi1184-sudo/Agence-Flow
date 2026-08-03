<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Modifier la tâche') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">

            <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la tâche</label>
                    <input type="text" name="titre" value="{{ old('titre', $task->titre) }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                    @error('titre') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Campagne</label>
                    <select name="campaign_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        @foreach ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ old('campaign_id', $task->campaign_id) == $campaign->id ? 'selected' : '' }}>
                                {{ $campaign->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('campaign_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Assigné à</label>
                    <select name="user_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                        <select name="priorite" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                            <option value="basse" {{ old('priorite', $task->priorite) === 'basse' ? 'selected' : '' }}>Basse</option>
                            <option value="moyenne" {{ old('priorite', $task->priorite) === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                            <option value="haute" {{ old('priorite', $task->priorite) === 'haute' ? 'selected' : '' }}>Haute</option>
                        </select>
                        @error('priorite') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select name="statut" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                            <option value="a_faire" {{ old('statut', $task->statut) === 'a_faire' ? 'selected' : '' }}>À faire</option>
                            <option value="en_cours" {{ old('statut', $task->statut) === 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="en_revision" {{ old('statut', $task->statut) === 'en_revision' ? 'selected' : '' }}>En révision</option>
                            <option value="termine" {{ old('statut', $task->statut) === 'termine' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        @error('statut') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                    @error('deadline') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('tasks.show', $task) }}" class="text-sm text-gray-500 hover:underline">
                        Annuler
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>