<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Guard and Password Broker
    |--------------------------------------------------------------------------
    |
    | Ces options définissent les gardiens d'authentification et les courtiers
    | de mot de passe par défaut pour votre application. Vous pouvez les modifier
    | selon les besoins de votre application.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // Garde par défaut
        'passwords' => env('AUTH_PASSWORD_BROKER', 'utilisateurs'), // Courtier de mot de passe par défaut
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Vous pouvez définir plusieurs gardiens pour gérer différents types
    | d'utilisateurs (par exemple, administrateurs, clients, agents).
    | Chaque gardien utilise un fournisseur utilisateur.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'utilisateurs', // Fournisseur utilisateur pour le garde "web"
        ],

        'agent' => [
            'driver' => 'session',
            'provider' => 'agents', // Fournisseur utilisateur pour le garde "agent"
        ],

        'client' => [
            'driver' => 'session',
            'provider' => 'clients', // Fournisseur utilisateur pour le garde "client"
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Chaque fournisseur utilisateur définit comment les utilisateurs sont récupérés
    | à partir de votre base de données ou d'autres systèmes de stockage.
    |
    */

    'providers' => [
        'utilisateurs' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Modèle pour les utilisateurs
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => App\Models\Agent::class, // Modèle pour les agents
        ],

        'clients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Client::class, // Modèle pour les clients
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Ces paramètres définissent les options de réinitialisation des mots de passe
    | pour chaque type d'utilisateur (utilisateur, agent, client).
    |
    */

    'passwords' => [
        'utilisateurs' => [
            'provider' => 'utilisateurs',
            'table' => 'password_resets', // Table utilisée pour les réinitialisations de mot de passe
            'expire' => 60, // Délai en minutes avant que le lien expire
            'throttle' => 60, // Délai minimum entre deux tentatives de réinitialisation
        ],

        'agents' => [
            'provider' => 'agents',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'clients' => [
            'provider' => 'clients',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Timeout
    |--------------------------------------------------------------------------
    |
    | Cette option définit la durée (en secondes) pendant laquelle un utilisateur
    | peut rester authentifié après avoir confirmé son mot de passe.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
