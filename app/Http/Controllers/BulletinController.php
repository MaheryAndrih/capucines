<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use Illuminate\Http\Request;

class BulletinController extends Controller{

    public function to_generer_bulletin(){
        $classes = Classe::all();
        return view('bulletin.genererBulletin',compact('classes'));
    }

    public function genererBulletin(){
        return view('bulletin.listeBulletin');
    }

}

?>