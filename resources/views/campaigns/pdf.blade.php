<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .subtitle { color: #6b7280; margin-bottom: 24px; }
        .box { border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px; }
        .row { margin-bottom: 8px; }
        .label { color: #9ca3af; font-size: 10px; text-transform: uppercase; }
        .value { font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f9fafb; text-align: left; padding: 8px; font-size: 10px; color: #6b7280; text-transform: uppercase; }
        td { padding: 8px; border-bottom: 1px solid #f3f4f6; font-size: 12px; }
        .badge { padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .badge-cours { background: #dbeafe; color: #1d4ed8; }
        .badge-termine { background: #f3f4f6; color: #4b5563; }
        .badge-pause { background: #fef3c7; color: #92400e; }
        .footer { margin-top: 30px; font-size: 10px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>

    <h1>{{ $campaign->nom }}</h1>
    <p class="subtitle">Rapport de campagne — 212Communication</p>

    <div class="box">
        <div class="row">
            <span class="label">Client</span><br>
            <span class="value">{{ $campaign->client->nom ?? '—' }}</span>
        </div>
        <div class="row">
            <span class="label">Période</span><br>
            <span class="value">{{ $campaign->date_debut->format('d/m/Y') }} → {{ $campaign->date_fin->format('d/m/Y') }}</span>
        </div>
        <div class="row">
            <span class="label">Statut</span><br>
            <span class="badge badge-{{ $campaign->statut === 'en_cours' ? 'cours' : ($campaign->statut === 'termine' ? 'termine' : 'pause') }}">
                {{ $campaign->statut }}
            </span>
        </div>
        <div class="row">
            <span class="label">Objectifs</span><br>
            <span class="value">{{ $campaign->objectifs ?? 'Non défini' }}</span>
        </div>
    </div>

    <h3>Tâches ({{ $campaign->tasks->count() }})</h3>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Assigné à</th>
                <th>Priorité</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($campaign->tasks as $task)
                <tr>
                    <td>{{ $task->titre }}</td>
                    <td>{{ $task->user->name ?? '—' }}</td>
                    <td>{{ $task->priorite }}</td>
                    <td>{{ $task->statut }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Aucune tâche</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Généré le {{ now()->format('d/m/Y à H:i') }} — AgenceFlow
    </div>

</body>
</html>