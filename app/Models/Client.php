<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée.
     *
     * @var string
     */
    protected $table = 'client'; // Vérifie si c'est bien 'client' et pas 'clients'

    /**
     * Clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_client';

    /**
     * Désactiver les timestamps si non utilisés.
     *
     * @var bool
     */
    public $timestamps = false;

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
     * Accessoire pour obtenir le nom complet du client.
     */
    public function getNomCompletAttribute()
    {
        return "{$this->prenom_client} {$this->nom_client}";
    }

    /**
     * Caster les colonnes à leurs types respectifs.
     *
     * @var array
     */
    protected $casts = [
        'date_nais_client' => 'date',
    ];

    /**
     * Relation avec les biens favoris.
     */
    public function favoriteBiens()
    {
        return $this->belongsToMany(
            Bien::class,
            'client_favorite_biens', // Nom exact de la table pivot
            'client_id', // Clé étrangère côté Client
            'bien_id' // Clé étrangère côté Bien
        )->withTimestamps(); // Si la table pivot a des timestamps
    }
}
