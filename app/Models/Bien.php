<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    /**
     * Nom de la table associée.
     *
     * @var string
     */
    protected $table = 'bien';

    /**
     * Clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_bien';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'type_bien',
        'type_transaction',
        'disponibilite',
        'prix',
        'adresse',
        'cp',
        'ville',
        'region',
        'pays',
        'superficie',
        'surface_terrain',
        'nb_etage',
        'nb_piece',
        'nb_chambre',
        'id_agent',
        'id_agence',
    ];

    /**
     * Relation : un bien appartient à un agent.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'id_agent');
    }

    /**
     * Relation : un bien appartient à une agence.
     */
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence');
    }

    /**
     * Relation : un bien possède plusieurs images.
     */
    public function images()
    {
        return $this->belongsToMany(ImageBien::class, 'montrer', 'id_bien', 'id_image');
    }

    /**
     * Relation : un bien possède plusieurs statistiques.
     */
    public function statistiques()
    {
        return $this->hasMany(StatistiqueBien::class, 'id_bien');
    }

    /**
     * Relation : un bien appartient à un client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Définir un accessoire pour formater le prix.
     *
     * @return string
     */
    public function getFormattedPrixAttribute()
    {
        return number_format($this->prix, 2, ',', ' ') . ' €';
    }

    /**
     * Définir un accessoire pour l'adresse complète.
     *
     * @return string
     */
    public function getAdresseCompleteAttribute()
    {
        return "{$this->adresse}, {$this->cp} {$this->ville}, {$this->region}, {$this->pays}";
    }
}
