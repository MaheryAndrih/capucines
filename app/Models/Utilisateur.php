<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id_utilisateur';
    protected $fillable = ['id_utilisateur','username','password'];
    protected $table = 'utilisateur';

    public static $prefixe = 'USR';

    public static $nomSequence = 'utilisateur_seq';

    public function store(array $data)
    {
        //generer l'id eleve grace au fonction generateObjectId dans le model Objet
        $id = Utilisateur::generateId();
        // Créer et enregistrer l'éléve
        $this->fill([
            'id_utilisateur' => $id,
            'username' => $data['username'],
            'password' => $data['password'],
        ]);
        $this->save();
    }
}