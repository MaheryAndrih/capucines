<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportEleveTemporaire extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'import_eleve_temporaire';

    protected $fillable = [
        'numero',
        'noms',
        'prenoms',
        'genre',
        'dtn',
        'matricule'
    ];
}
