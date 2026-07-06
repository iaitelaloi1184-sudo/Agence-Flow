<!DOCTYPE html>
<html>
<head>
    <title>{{ $client->nom }}</title>
</head>
<body>
    <h1>{{ $client->nom }}</h1>

    <p><strong>Email :</strong> {{ $client->email ?? 'Non renseigné' }}</p>
    <p><strong>Téléphone :</strong> {{ $client->telephone ?? 'Non renseigné' }}</p>
    <p><strong>Secteur :</strong> {{ $client->secteur ?? 'Non renseigné' }}</p>
    <p><strong>Ton de communication :</strong> {{ $client->ton_communication ?? 'Non renseigné' }}</p>

    <h2>Campagnes</h2>
    @forelse($client->campaigns as $campaign)
        <p>{{ $campaign->nom }} — {{ $campaign->statut }}</p>
    @empty
        <p>Aucune campagne pour ce client</p>
    @endforelse

    <a href="{{ route('clients.edit', $client) }}">Modifier</a>
    <a href="{{ route('clients.index') }}">Retour à la liste</a>
</body>
</html>