<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Biens</title>
</head>
<body>
<h1>Liste des biens</h1>
@if($biens->isEmpty())
    <p>Aucun bien disponible.</p>
@else
    <ul>
        @foreach ($biens as $bien)
            <li>{{ $bien->titre }} - {{ $bien->prix }} €</li>
        @endforeach
    </ul>
@endif
</body>
</html>
