<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs'; // Spécifiez la table utilisateurs

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    /**
     * Spécifie à Laravel le champ à utiliser pour le mot de passe.
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
