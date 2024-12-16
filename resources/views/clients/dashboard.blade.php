@extends('layouts.app')

@section('content')
    <h1>Tableau de bord du client</h1>

    <h2>Biens favoris</h2>
    @if ($favoriteProperties->isEmpty())
        <p>Vous n'avez pas encore ajouté de biens à vos favoris.</p>
    @else
        <ul>
            @foreach ($favoriteProperties as $bien)
                <li>
                    <h3>{{ $bien->titre }}</h3>
                    <p>{{ $bien->description }}</p>
                    <p>Prix : {{ number_format($bien->prix, 2, ',', ' ') }} €</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
