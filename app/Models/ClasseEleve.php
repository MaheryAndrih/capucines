<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseEleve extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['id_classe','matricule','numero'];
    protected $table = 'classe_eleve';
}