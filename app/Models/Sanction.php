<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanction extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id_sanction';
    protected $fillable = ['id_sanction','matricule','motif'];
    protected $table = 'sanction';

    public static $prefixe = 'SCT';

    public static $nomSequence = 'sanction_seq';

    public function store(array $data)
    {
        //generer l'id eleve grace au fonction generateObjectId dans le model Objet
        $id = Sanction::generateId();
        // Créer et enregistrer l'éléve
        $this->fill([
            'id_sanction' => $id,
            'matricule' => $data['matricule'],
            'motif' => $data['motif'],
        ]);
        $this->save();
    }
}
