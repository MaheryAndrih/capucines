<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClasseMatiereCoefficient;
use App\Models\VClasseMatiereCoefficient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoefficientController extends Controller
{
    //
    public function choixClasse(){
        $classes = Classe::all();
        return view('administration.coefficient.consulter_coef',['classes' => $classes]);
    }

    public function listeCoefficient(Request $request){
        $id_classe = $request->input('id_classe');
        $listeCoefficient = VClasseMatiereCoefficient::where('id_classe',$id_classe)->get();
        return view('administration.coefficient.liste_coefficient',['listeCoefficient' => $listeCoefficient]);
    }

    public function update(Request $request){
        DB::table('classe_matiere_coefficient')
            ->where('id_classe',$request->input('id_classe'))
            ->where('id_matiere',$request->input('id_matiere'))
            ->update(['coefficient' => $request->input('coefficient')]);
        return redirect()->back();
    }

    public function delete(Request $request){
        DB::table('classe_matiere_coefficient')
            ->where('id_classe',$request->input('id_classe'))
            ->where('id_matiere',$request->input('id_matiere'))
            ->delete();
        return redirect()->back();
    }
}
