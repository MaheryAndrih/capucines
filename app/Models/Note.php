<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Objet
{
    use HasFactory;

    protected $table = 'note';

    public $incrementing = false; // Désactive l'auto-incrémentation
    
    public $timestamps = false;   // Désactive les colonnes timestamps si elles ne sont pas utilisées

    protected $primaryKey = 'id_note'; // Indique qu'il n'y a pas de clé primaire

    protected $keyType = 'string';

    public static $prefixe = 'NTE';

    public static $nomSequence = 'note_seq';

    protected $fillable = [
        'id_note',
        'id_classe',
        'id_eleve',
        'id_matiere',
        'id_epreuve',
        'note',
    ];

    public function store(array $data)
    {
        //generer l'id eleve grace au fonction generateObjectId dans le model Objet
        $id_note = Note::generateId();
        // Créer et enregistrer l'éléve
        $this->fill([
            'id_note' => $id_note,
            'id_classe' => $data['id_classe'],
            'id_eleve' => $data['id_eleve'],
            'id_matiere' => $data['id_matiere'],
            'id_epreuve' => $data['id_epreuve'],
            'note' => $data['note'],
        ]);
        $this->save();
    }    
}
