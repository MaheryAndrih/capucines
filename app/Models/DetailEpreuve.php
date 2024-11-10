<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEpreuve extends Model
{
    use HasFactory;

    protected $table = 'detail_epreuve';

    protected $fillable = [
        'id_epreuve_mere',
        'id_epreuve_fille'
    ];

    public $timestamps = false;
}
