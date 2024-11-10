<?php

namespace App\Http\Controllers;
use App\Models\VClasseMatiereCoefficient;
use App\Models\Matiere;
use App\Models\Epreuve;
use App\Models\VNoteClasse;
use App\Models\VEleve;
use App\Models\Classe;
use App\Models\DetailEpreuve;
use App\Models\RapportMatiere;
use App\Models\VDetailEpreuve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $randomNumbers = [];
        $eleves_total = count($eleves);
        for($i = 0; $i < $eleves_total; $i++){
            $randomNumbers[] = round(mt_rand(967,1724) / 100, 2);
        }
        // dd($randomNumbers);
        return view('bulletin.listeBulletin',compact('eleves','id_classe','id_epreuve','date','randomNumbers'));
    }

    public function to_rang_matiere(){
        $classes = Classe::all();
        $idClasseSelectionnee = request('id_classe') ?? $classes->first()->id_classe;
        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)->get();
        $epreuves = Epreuve::whereIn('code_epreuve', ['EXI', 'EXII', 'EXIII'])->get();
        return view('bulletin.rapport.rang_matiere',compact('classes','matieres','epreuves'));
    }

    public function select_rapport_matiere(Request $request){
        $id_data =  $request->only(['id_epreuve','id_matiere','id_classe']);
        $matiere = Matiere::find($id_data['id_matiere']);
        $classe = Classe::find($id_data['id_classe']);
        $epreuve = Epreuve::find($id_data['id_epreuve']);
        $details_epreuve = VDetailEpreuve::where('id_epreuve_mere',$epreuve->id_epreuve)->get();
        $resultats = DB::select('SELECT * FROM f_rapport_matiere(?, ?, ?)', [$id_data['id_classe'], $id_data['id_matiere'],$id_data['id_epreuve']]);

        $rapport_matiere = collect($resultats)->map(function ($item) {
            return new RapportMatiere((array) $item);
        });
        return view('bulletin.rapport.rapport_matiere',compact('classe','matiere','epreuve','rapport_matiere','details_epreuve'));
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