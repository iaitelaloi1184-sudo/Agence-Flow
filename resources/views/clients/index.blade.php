<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
</head>
<body>
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}">+ Ajouter un client</a>

    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Secteur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->secteur }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client) }}">Voir</a>
                        <a href="{{ route('clients.edit', $client) }}">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun client trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>