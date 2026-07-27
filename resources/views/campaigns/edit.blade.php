<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Modifier la campagne') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">

            <form method="POST" action="{{ route('campaigns.update', $campaign) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la campagne</label>
                    <input type="text" name="nom" value="{{ old('nom', $campaign->nom) }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                    @error('nom') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $campaign->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                        <input type="date" name="date_debut" value="{{ old('date_debut', $campaign->date_debut->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        @error('date_debut') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                        <input type="date" name="date_fin" value="{{ old('date_fin', $campaign->date_fin->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        @error('date_fin') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Objectifs</label>
                    <textarea name="objectifs" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">{{ old('objectifs', $campaign->objectifs) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="statut" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="en_cours" {{ old('statut', $campaign->statut) === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="pause" {{ old('statut', $campaign->statut) === 'pause' ? 'selected' : '' }}>En pause</option>
                        <option value="termine" {{ old('statut', $campaign->statut) === 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                    @error('statut') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('campaigns.show', $campaign) }}" class="text-sm text-gray-500 hover:underline">
                        Annuler
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>