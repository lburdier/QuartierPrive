protected $routeMiddleware = [
    // ...existing code...
    'role' => \App\Http\Middleware\CheckRole::class,
];
