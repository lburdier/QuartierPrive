<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <title>FollowUp</title>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="menu container">
            <ul>
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="{{ route('patients.index') }}">Liste des Patients</a></li>
                <li><a href="{{ route('patients.create') }}">Ajouter un Patient</a></li>
                <li><a href="{{ route('incidents.create') }}">Enregistrer un Incident</a></li>
                <li><a href="{{ route('incidents.index') }}">Liste des Incidents</a></li>
            </ul>
        </div>
    </nav>
</header>
</body>
</html>
