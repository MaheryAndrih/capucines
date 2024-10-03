<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenom','dtn','genre','nom_pere','profession_pere','numero_pere','nom_mere','profession_mere','numero_mere'];
    protected $table = 'eleve';
}