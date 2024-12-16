@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Liste des biens disponibles</h1>

        @if ($biens->isEmpty())
            <p>Aucun bien disponible pour le moment.</p>
        @else
            <div class="row">
                @foreach ($biens as $bien)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bien->titre }}</h5>
                                <p class="card-text">Prix : {{ number_format($bien->prix, 2, ',', ' ') }} €</p>
                                <p>Ville : {{ $bien->ville }}</p>
                                <a href="{{ route('biens.show', $bien->id) }}" class="btn btn-primary">Voir les
                                    détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $biens->links() }}
            </div>
        @endif
    </div>
@endsection
