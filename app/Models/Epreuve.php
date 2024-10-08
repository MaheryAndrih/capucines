<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $primaryKey = 'id_epreuve';
    protected $table = 'epreuve';
}
