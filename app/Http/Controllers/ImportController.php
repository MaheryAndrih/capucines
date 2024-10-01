<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    //
    public function showImport(){
        $classes = Classe::select('id_classe','nom_classe')->get();
        return view('import.showImportView',['classes'=>$classes]);
    }
}
