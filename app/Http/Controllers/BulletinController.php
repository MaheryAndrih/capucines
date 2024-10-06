<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\VClasseMatiereCoefficient;
use App\Models\Matiere;
use App\Models\Epreuve;
use App\Models\VNoteClasse;
use Illuminate\Http\Request;

class BulletinController extends Controller{

    public function to_generer_bulletin(){
        $classes = Classe::all();
        return view('bulletin.genererBulletin',compact('classes'));
    }

    public function genererBulletin(){
        return view('bulletin.listeBulletin');
    }

    public function to_rang_matiere(){
        $classes = Classe::all();
        $idClasseSelectionnee = request('id_classe') ?? $classes->first()->id_classe;

        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)->get();
        return view('bulletin.rapport.rang_matiere',compact('classes','matieres'));
    }

    public function select_rapport_matiere(){
        $classe = Classe::find(request('id_classe'));
        $matiere = Matiere::find(request('id_matiere'));
        $notes = VNoteClasse::where('id_classe',request('id_classe'))
            ->where('id_matiere',request('id_matiere'))
            ->orderBy('numero')
            ->get();
        return view('bulletin.rapport.liste_eleve',compact('classe','matiere','notes'));
    }

    public function to_rang_examen(){
        $classes = Classe::all();
        return view('bulletin.rapport.rang_examen',compact('classes'));
    }

    public function select_rapport_examen(){
        $classe = Classe::find(request('id_classe'));
        $epreuve = Epreuve::find(request('id_epreuve'));
        return view('bulletin.rapport.liste_rang_examen',compact('classe','epreuve'));
    }

}

?>