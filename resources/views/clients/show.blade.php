<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Détails du client</h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">

        <dl class="divide-y divide-gray-100">
            <div class="py-3 flex">
                <dt class="w-40 text-sm font-medium text-gray-500">Nom</dt>
                <dd class="text-sm text-gray-800">{{ $client->nom }}</dd>
            </div>
            <div class="py-3 flex">
                <dt class="w-40 text-sm font-medium text-gray-500">Secteur</dt>
                <dd class="text-sm text-gray-800">{{ $client->secteur }}</dd>
            </div>
            <div class="py-3 flex">
                <dt class="w-40 text-sm font-medium text-gray-500">Email</dt>
                <dd class="text-sm text-gray-800">{{ $client->email }}</dd>
            </div>
            <div class="py-3 flex">
                <dt class="w-40 text-sm font-medium text-gray-500">Téléphone</dt>
                <dd class="text-sm text-gray-800">{{ $client->telephone }}</dd>
            </div>
            <div class="py-3 flex">
                <dt class="w-40 text-sm font-medium text-gray-500">Ton de communication</dt>
                <dd class="text-sm text-gray-800">{{ $client->ton_communication }}</dd>
            </div>
        </dl>

        <div class="flex gap-3 pt-4">
            @role('admin')
                <a href="{{ route('clients.edit', $client) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-yellow-600">
                    Modifier
                </a>
            @endrole
            <a href="{{ route('clients.index') }}"
               class="text-gray-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">
                Retour à la liste
            </a>
        </div>
    </div>
</x-app-layout>