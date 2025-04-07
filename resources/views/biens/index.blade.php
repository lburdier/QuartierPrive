@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des biens disponibles</h1>

        @if ($biens->isEmpty())
            <div class="alert alert-warning text-center">Aucun bien disponible pour le moment.</div>
        @else
            <div class="row">
                @foreach ($biens as $bien)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bien->titre }}</h5>
                                <p class="card-text"><strong>Prix :</strong> {{ number_format($bien->prix, 2, ',', ' ') }} €</p>
                                <p class="card-text"><strong>Ville :</strong> {{ $bien->ville }}</p>

                                @if(isset($bien->id))
                                    <a href="{{ route('biens.show', ['id' => $bien->id]) }}" class="btn btn-primary w-100">Voir les détails</a>
                                @else
                                    <span class="text-danger">Erreur : ID manquant</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $biens->links() }}
            </div>
        @endif
    </div>
@endsection
