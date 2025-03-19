<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Bienvenue sur notre application</h1>
    <p class="text-center">Gérez vos biens et clients facilement.</p>

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('biens.index') }}" class="btn btn-primary me-2">Voir les Biens</a>
        @auth
            <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se Déconnecter</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Se Connecter</a>
        @endauth
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
