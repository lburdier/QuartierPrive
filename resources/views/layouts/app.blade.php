<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/dark.css') }}" rel="stylesheet">
    <style>
        /* Thème inspiré de ChatGPT */
        body {
            background-color: #1e1e1e;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
        }
        .form-label {
            color: #ffffff;
        }
        .form-control {
            background-color: #3a3a3a;
            color: #ffffff;
            border: 1px solid #555555;
        }
        .btn-primary {
            background-color: #1a73e8;
            border-color: #1a73e8;
        }
        .btn-primary:hover {
            background-color: #1763c1;
            border-color: #1763c1;
        }
        .alert-danger {
            background-color: #721c24;
            border-color: #721c24;
            color: #ffffff;
        }
    </style>
</head>
<body>
    @include('components.header')
    @include('components.menu')
    <div class="container mt-5">
        @yield('content')
    </div>
    @include('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
