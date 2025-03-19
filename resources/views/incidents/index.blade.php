<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des incidents</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Liste des incidents</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidents as $incident)
                        <tr>
                            <td>{{ $incident->id }}</td>
                            <td>{{ $incident->title }}</td>
                            <td>{{ $incident->description }}</td>
                            <td>
                                <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-primary">Voir</a>
                                <a href="{{ route('incidents.edit', $incident->id) }}" class="btn btn-secondary">Modifier</a>
                                <form action="{{ route('incidents.destroy', $incident->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
