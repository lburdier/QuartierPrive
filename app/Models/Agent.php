<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agent';
    protected $primaryKey = 'id_agent';

    protected $fillable = [
        'nom', 'prenom', 'tel_agent', 'mail_agent',
        'cp_agent', 'echelon', 'id_agence'
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence');
    }

    public function biens()
    {
        return $this->hasMany(Bien::class, 'id_agent');
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'id_agent');
    }

    public function statistiques()
    {
        return $this->hasOne(StatistiqueAgent::class, 'id_agent');
    }
}
