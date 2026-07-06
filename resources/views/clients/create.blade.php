<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client</title>
</head>
<body>
    <h1>Ajouter un client</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('clients.store') }}">
        @csrf

        <label>Nom *</label><br>
        <input type="text" name="nom" value="{{ old('nom') }}"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Téléphone</label><br>
        <input type="text" name="telephone" value="{{ old('telephone') }}"><br><br>

        <label>Secteur</label><br>
        <input type="text" name="secteur" value="{{ old('secteur') }}"><br><br>

        <label>Ton de communication</label><br>
        <input type="text" name="ton_communication" value="{{ old('ton_communication') }}"><br><br>

        <button type="submit">Enregistrer</button>
        <a href="{{ route('clients.index') }}">Annuler</a>
    </form>
</body>
</html>