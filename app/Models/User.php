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

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un client.
     */
    public function isClient()
    {
        return $this->role === 'client';
    }

    /**
     * Vérifie si l'utilisateur est un agent.
     */
    public function isAgent()
    {
        return $this->role === 'agent';
    }

    /**
     * Définit le mot de passe de l'utilisateur.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['mot_de_passe'] = Hash::make($value);
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
