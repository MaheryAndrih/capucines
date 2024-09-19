<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseMatiereCoefficient extends Model
{
    use HasFactory;

    protected $table = 'classe_matiere_coefficient';

    public $incrementing = false; // Désactive l'auto-incrémentation
    
    public $timestamps = false;   // Désactive les colonnes timestamps si elles ne sont pas utilisées

    protected $primaryKey = null; // Indique qu'il n'y a pas de clé primaire
}
