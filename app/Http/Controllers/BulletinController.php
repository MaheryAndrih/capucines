<?php

namespace App\Http\Controllers;
use App\Models\VClasseMatiereCoefficient;
use App\Models\Matiere;
use App\Models\Epreuve;
use App\Models\VNoteClasse;
use App\Models\VEleve;
use App\Models\Classe;
use Illuminate\Http\Request;

class BulletinController extends Controller{

    public function to_generer_bulletin(){
        $classes = Classe::orderBy('id_classe')->get();
        $epreuves = Epreuve::whereIn('code_epreuve', ['EXI', 'EXII', 'EXIII'])->get();
        return view('bulletin.genererBulletin',compact('classes','epreuves'));
    }

    public function genererBulletin(Request $request){
        $id_classe = $request->input('id_classe');
        $id_epreuve = $request->input('id_epreuve');
        $eleves = VEleve::where('id_classe',$id_classe)->OrderBy('numero')->get();
        $date = date('Y-m-d');
        return view('bulletin.listeBulletin',compact('eleves','id_classe','id_epreuve','date'));
    }

    public function to_rang_matiere(){
        $classes = Classe::all();
        $idClasseSelectionnee = request('id_classe') ?? $classes->first()->id_classe;
        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)->get();
        return view('bulletin.rapport.rang_matiere',compact('classes','matieres'));
    }

    public function select_rapport_matiere(){
        $classe = Classe::find(request('id_classe'));
        $id_matiere = request('id_matiere');
        $matiere = Matiere::find($id_matiere);
        $els = VEleve::where('id_classe',request('id_classe'))->get();
        $id_epreuve = request('id_epreuve');
        $epreuves = [];
        $i=0;
        while($i<3){
            $epreuve = Epreuve::find('EPR00000'.$id_epreuve);
            array_push($epreuves, $epreuve);
            $id_epreuve++;
            $i++;
        }
        $eleves = $els->sortByDesc(function ($eleve) use($epreuves,$id_matiere) {
            return $eleve->getMoyenneMatiere($epreuves,$id_matiere);
        });
        return view('bulletin.rapport.liste_eleve',compact('classe','matiere','eleves','id_epreuve','epreuves'));
    }

    public function to_rang_examen(){
        $classes = Classe::all();
        return view('bulletin.rapport.rang_examen',compact('classes'));
    }

    public function select_rapport_examen(){
        $classe = Classe::find(request('id_classe'));
        $id_epreuve = request('id_epreuve');
        $epreuve = Epreuve::find($id_epreuve);
        $eleves = VEleve::where('id_classe',request('id_classe'))->get();
        $epreuves = [];
        $i=0;
        while($i<3){
            $epr = Epreuve::find('EPR00000'.$id_epreuve);
            array_push($epreuves, $epr);
            $id_epreuve++;
            $i++;
        }
        return view('bulletin.rapport.liste_rang_examen',compact('classe','epreuve','eleves','epreuves'));
    }

}

?>