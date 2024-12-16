<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Bienvenue sur notre application Laravel</h1>
    <p class="text-center">Ceci est la page d'accueil.</p>

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('biens.index') }}" class="btn btn-primary me-2">Voir les Biens</a>
        <a href="{{ route('login') }}" class="btn btn-secondary">Se Connecter</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
