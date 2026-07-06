<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Campagnes') }}
        </h2>
    </x-slot>

    <div class="space-y-4">

        @if (session('success'))
            <div class="bg-green-50 text-green-700 text-sm px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h3 class="text-sm text-gray-500">{{ $campaigns->count() }} campagne(s)</h3>
            <a href="{{ route('campaigns.create') }}"
               class="bg-gray-900 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Nouvelle campagne
            </a>
        </div>

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
                    @forelse ($campaigns as $campaign)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $campaign->nom }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $campaign->client->nom ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $campaign->date_debut->format('d/m/Y') }} → {{ $campaign->date_fin->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full
                                    @if($campaign->statut === 'en_cours') bg-blue-100 text-blue-700
                                    @elseif($campaign->statut === 'termine') bg-gray-100 text-gray-600
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ $campaign->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('campaigns.show', $campaign) }}" class="text-red-600 hover:underline text-sm">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">Aucune campagne pour le moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>