<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Modifier le client</h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $client->nom) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Secteur</label>
                <input type="text" name="secteur" value="{{ old('secteur', $client->secteur) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $client->email) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $client->telephone) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ton de communication</label>
                <input type="text" name="ton_communication" value="{{ old('ton_communication', $client->ton_communication) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700">
                    Modifier
                </button>
                <a href="{{ route('clients.index') }}"
                   class="text-gray-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>