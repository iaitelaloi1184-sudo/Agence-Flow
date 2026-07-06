<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Campagnes') }}
        </h2>
    </x-slot>

    <div class="space-y-4" x-data="{
        search: '',
        campaigns: {{ $campaigns->map(fn($c) => [
            'id' => $c->id,
            'nom' => $c->nom,
            'client' => $c->client->nom ?? '—',
            'periode' => $c->date_debut->format('d/m/Y') . ' → ' . $c->date_fin->format('d/m/Y'),
            'statut' => $c->statut,
            'url' => route('campaigns.show', $c),
        ])->toJson() }}
    }">

        @if (session('success'))
            <div class="bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between gap-4">
            <input type="text" x-model="search" placeholder="Rechercher une campagne ou un client..."
                class="w-full max-w-xs px-4 py-2 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600">

            <a href="{{ route('campaigns.create') }}"
               class="shrink-0 bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Nouvelle campagne
            </a>
        </div>

        <p class="text-sm text-gray-500" x-text="campaigns.filter(c => c.nom.toLowerCase().includes(search.toLowerCase()) || c.client.toLowerCase().includes(search.toLowerCase())).length + ' campagne(s)'"></p>

        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-left">
                    <tr>
                        <th class="px-6 py-3 font-medium">Campagne</th>
                        <th class="px-6 py-3 font-medium">Client</th>
                        <th class="px-6 py-3 font-medium">Période</th>
                        <th class="px-6 py-3 font-medium">Statut</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="campaign in campaigns.filter(c => c.nom.toLowerCase().includes(search.toLowerCase()) || c.client.toLowerCase().includes(search.toLowerCase()))" :key="campaign.id">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900" x-text="campaign.nom"></td>
                            <td class="px-6 py-4 text-gray-500" x-text="campaign.client"></td>
                            <td class="px-6 py-4 text-gray-500" x-text="campaign.periode"></td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full"
                                    :class="{
                                        'bg-blue-100 text-blue-700': campaign.statut === 'en_cours',
                                        'bg-gray-100 text-gray-600': campaign.statut === 'termine',
                                        'bg-yellow-100 text-yellow-700': campaign.statut === 'pause'
                                    }"
                                    x-text="campaign.statut"></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a :href="campaign.url" class="text-red-600 hover:underline text-sm">Voir</a>
                            </td>
                        </tr>
                    </template>

                    <tr x-show="campaigns.filter(c => c.nom.toLowerCase().includes(search.toLowerCase()) || c.client.toLowerCase().includes(search.toLowerCase())).length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">Aucun résultat pour cette recherche</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>