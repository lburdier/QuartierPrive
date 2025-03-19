<nav class="navbar">
    <ul class="menu">
        <li><a href="{{ route('biens.index') }}">Nos Biens</a></li>
        <li><a href="{{ route('clients.index') }}">Nos Clients</a></li>
        <li><a href="{{ route('agents.index') }}">Nos Agents</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        @auth
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se Déconnecter</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <li><a href="{{ route('login') }}">Se Connecter</a></li>
            <li><a href="{{ route('register') }}">S'inscrire</a></li>
        @endauth
    </ul>
</nav>
