<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VNoteClasse extends Model
{
    use HasFactory;
    
    protected $table = 'v_note_classe';

    protected $fillable = [
        'id_note',
        'id_classe',
        'id_eleve',
        'id_matiere',
        'id_epreuve',
        'note',
    ];
}
