<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Epreuve;
use App\Models\Matiere;
use App\Models\VClasseMatiereCoefficient;
use App\Models\VEpreuve;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function acceuil(Request $request){
        $classes = Classe::all();
        $idClasseSelectionnee = $request->input('id_classe') ?? $classes->first()->id_classe;

        // Récupérer les matières correspondant à la classe sélectionnée
        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)
                      ->select('id_matiere', 'code_matiere')
                      ->get();

        $epreuves = VEpreuve::where('id_classe', $idClasseSelectionnee)
            ->select('id_epreuve', 'code_epreuve')
            ->get();
        return view('note.selectionNote',
            [
                'classes' => $classes,
                'matieres' => $matieres,
                'epreuves' => $epreuves,
                'idClasseSelectionnee' => $idClasseSelectionnee
            ]
        );
    }

    public function getMatieres($idClasse){
        $matieres = VClasseMatiereCoefficient::where('id_classe',$idClasse)->select('id_matiere','code_matiere')->get();
        return response()->json($matieres);
    }

    public function getEpreuves($idClasse){
        $epreuves = VEpreuve::where('id_classe',$idClasse)->select('id_epreuve', 'code_epreuve')->get();
        return response()->json($epreuves);
    }




}
