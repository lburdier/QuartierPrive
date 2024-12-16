<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <title>FollowUp</title>
</head>
<body>
<footer class="footer">
    <div class="footer-content">
        <p>&copy; {{ date('Y') }} Mon Application. Tous droits réservés.</p>
        <nav>
            <ul class="footer-nav">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</footer>
</body>
</html>

