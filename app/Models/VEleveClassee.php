<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VEleveClassee extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenom','numero','id_classe'];
    protected $table = 'v_eleve_classee';

}