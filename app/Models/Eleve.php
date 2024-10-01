<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id_eleve';
    protected $fillable = ['id_eleve','nom','prenom','dtn','genre','nom_pere','profession_pere','numero_pere','nom_mere','profession_mere','numero_mere'];
    protected $table = 'eleve';
}