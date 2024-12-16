<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    /**
     * Nom de la table associée.
     *
     * @var string
     */
    protected $table = 'agence';

    /**
     * Clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_agence';

    /**
     * Les colonnes qui peuvent être assignées en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom_agence',
        'adresse',
        'cp',
        'ville',
        'region',
        'pays',
        'telephone',
        'email',
        'statut',
    ];

    /**
     * Relation : une agence possède plusieurs agents.
     */
    public function agents()
    {
        return $this->hasMany(Agent::class, 'id_agence', 'id_agence');
    }

    /**
     * Relation : une agence possède plusieurs clients.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'id_agence', 'id_agence');
    }

    /**
     * Relation : une agence possède plusieurs biens.
     */
    public function biens()
    {
        return $this->hasMany(Bien::class, 'id_agence', 'id_agence');
    }

    /**
     * Relation : une agence possède plusieurs biens disponibles.
     */
    public function activeBiens()
    {
        return $this->hasMany(Bien::class, 'id_agence', 'id_agence')->where('disponibilite', 'Disponible');
    }

    /**
     * Accessoire pour récupérer l'adresse complète de l'agence.
     *
     * @return string
     */
    public function getAdresseCompleteAttribute()
    {
        return "{$this->adresse}, {$this->cp} {$this->ville}, {$this->region}, {$this->pays}";
    }

    /**
     * Cast des colonnes pour le typage.
     *
     * @var array
     */
    protected $casts = [
        'statut' => 'boolean',
    ];
}
