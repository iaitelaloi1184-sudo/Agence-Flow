@forelse($clients as $client)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-3 font-medium text-gray-800">{{ $client->nom }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $client->email }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $client->telephone }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $client->secteur }}</td>
        <td class="px-4 py-3 space-x-2">
            <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">Voir</a>
            @role('admin')
                <a href="{{ route('clients.edit', $client) }}" class="text-yellow-600 hover:underline">Modifier</a>
            @endrole
            @role('admin')
                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline"
                      onsubmit="return confirm('Supprimer ce client ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                </form>
            @endrole
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-4 py-6 text-center text-gray-400">Aucun client trouvé</td>
    </tr>
@endforelse