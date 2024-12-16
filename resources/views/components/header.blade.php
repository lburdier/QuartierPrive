<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <title>FollowUp</title>
</head>
<body>
<header class="header">
    <div class="header-container">
        <div class="navbar-brand">
            <span>FollowUp</span>
        </div>
        <button class="menu-toggle" aria-label="Toggle Menu">&#9776;</button> <!-- Bouton pour mobile -->
        <nav class="navbar">
            @include('components.menu')
        </nav>
    </div>
</header>

<!-- Contenu de la page -->

<script>
    // Script pour la gestion du menu mobile
    const toggleButton = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');

    toggleButton.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>

</body>
</html>
