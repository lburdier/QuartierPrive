<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Nom de la table associée.
     *
     * @var string
     */
    protected $table = 'client';

    /**
     * Clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_client';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom_client',
        'prenom_client',
        'date_nais_client',
        'adresse_client',
        'ville_client',
        'cp_client',
        'mail_client',
        'tel_client',
        'id_agence',
    ];

    /**
     * Relation avec l'agence.
     * Un client appartient à une agence.
     */
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence', 'id_agence');
    }

    /**
     * Définir un accessoire pour le nom complet du client.
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom_client . ' ' . $this->nom_client;
    }

    /**
     * Caster les colonnes à leurs types respectifs.
     *
     * @var array
     */
    protected $casts = [
        'date_nais_client' => 'date',
    ];
    // Relation pour les biens favoris
    public function favoriteBiens()
    {
        return $this->belongsToMany(Bien::class, 'client_favorite_biens', 'client_id', 'bien_id');
    }
}
