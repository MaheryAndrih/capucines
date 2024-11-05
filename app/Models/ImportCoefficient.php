<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportCoefficient extends Model
{
    use HasFactory;

    protected $table = 'import_coefficient';

    public $timestamps = false; 

    protected $fillable = [
        'code_classe',
        'code_matiere',
        'coefficient',
        'rang'
    ];
}
