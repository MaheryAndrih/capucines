<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportNote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'import_note';

    protected $fillable = [
        'code_epreuve',
        'code_classe',
        'code_matiere',
        'matricule',
        'nom',
        'prenom',
        'note'
    ];
}
