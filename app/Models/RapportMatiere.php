<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportMatiere extends Model
{
    // La fonction n'est pas directement associée à une table
    // Donc on peut utiliser un nom de table fictif ou même ne pas définir de table
    protected $table = null; // Pas de table associée

    // Si les colonnes retournées sont directement manipulables
    protected $fillable = [
        'id_classe', 'matricule', 'id_matiere', 'rang_matiere', 'nom', 'prenom',
        'numero', 'id_epreuve_mere', 'note_1', 'note_2', 'note_exam', 'coefficient',
        'moyenne', 'mc', 'rang'
    ];

    // Désactiver les timestamps si la fonction ne les gère pas
    public $timestamps = false;

    public function getMoyenneAttribute($value){
        return bcdiv($value,1, 2);
    }

    public function getMcAttribute($value){
        return bcdiv($value,1, 2);
    }

}

