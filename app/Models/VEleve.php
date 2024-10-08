<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VEleve extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenom','dtn','genre','nom_pere','profession_pere','numero_pere','nom_mere','profession_mere','numero_mere','id_classe','nom_classe','numero'];
    protected $table = 'v_eleve';

    public function getDtnAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y'); // Formate la date au format jour/mois/année
    }   
}