<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBien extends Model
{
    use HasFactory;

    protected $table = 'image_bien'; // Remplacez par le nom réel de la table
    protected $primaryKey = 'id'; // Remplacez par la clé primaire réelle si différente

    protected $fillable = [
        'file_path', // Ajoutez ici les colonnes de la table
        'bien_id',
    ];

    public function biens()
    {
        return $this->belongsToMany(Bien::class, 'montrer', 'id', 'id_bien');
    }
}
