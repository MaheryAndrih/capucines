<?php

namespace App\Http\Controllers;
use App\Models\VClasseMatiereCoefficient;
use App\Models\Matiere;
use App\Models\Epreuve;
use App\Models\VNoteClasse;
use App\Models\VEleve;
use App\Models\Classe;
use App\Models\ClasseEleve;
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
        $resultats = DB::select('SELECT * FROM f_rapport_etudiant_periode(?,?)',[$id_classe,$id_epreuve]);
        // dd($resultats[0]->moyenne);
        foreach($resultats as $resultat){
            $resultat->moyenne = bcdiv($resultat->moyenne,1,2);
        }
        $rapportGlobal = DB::select('SELECT * FROM f_rapport_global(?,?)',[$id_classe,$id_epreuve]);
        $rapportGlobal[0]->moyenne_classe = bcdiv($rapportGlobal[0]->moyenne_classe,1,2);
        $date = date('Y-m-d');
        return view('bulletin.listeBulletin',compact('id_classe','id_epreuve','date','resultats','rapportGlobal'));
    }

    public function to_rang_matiere(){
        $classes = Classe::orderBy('id_classe')->get();
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
        $moyenne = DB::select('SELECT f_moyenne_matiere_mere(?,?,?)',[$classe->id_classe,$matiere->id_matiere,$epreuve->id_epreuve]);
        $moyenne_value = $moyenne[0]->f_moyenne_matiere_mere;
        $moyenne_value = bcdiv($moyenne_value, 1,2);
        $rapport_matiere = collect($resultats)->map(function ($item) {
            return new RapportMatiere((array) $item);
        });
        return view('bulletin.rapport.rapport_matiere',compact('classe','matiere','epreuve','rapport_matiere','details_epreuve','moyenne_value'));
    }

    public function to_rang_examen(){
        $classes = Classe::orderBy('id_classe')->get();
        $epreuves = Epreuve::whereIn('code_epreuve', ['EXI', 'EXII', 'EXIII'])->get();
        return view('bulletin.rapport.rang_examen',compact('classes','epreuves'));
    }

    public function select_rapport_examen(Request $request){
        $id_classe = $request->input('id_classe');
        $id_epreuve = $request->input('id_epreuve');
        $resultats = DB::select('SELECT * FROM f_rapport_etudiant_periode(?,?)',[$id_classe,$id_epreuve]);
        $rapportGlobal = DB::select('SELECT * FROM f_rapport_global(?,?)',[$id_classe,$id_epreuve]);
        foreach($resultats as $resultat){
            $resultat->moyenne = bcdiv($resultat->moyenne,1,2);
        }
        $rapportGlobal[0]->moyenne_classe = bcdiv($rapportGlobal[0]->moyenne_classe,1,2);
        return view('bulletin.rapport.liste_rang_examen',compact('resultats','rapportGlobal'));
    }

    public function to_rang_annuel(){
        $classes = Classe::orderBy('id_classe')->get();
        $epreuves = Epreuve::whereIn('code_epreuve', ['EXI', 'EXII', 'EXIII'])->get();
        return view('bulletin.rapport.rang_annuel',compact('classes','epreuves'));
    }

    public function select_rapport_annuel(Request $request){
        $id_classe = $request->input('id_classe');
        $classe = Classe::find($id_classe);
        $resultats = DB::select('SELECT * FROM f_rapport_etudiant_annuel(?)',[$id_classe]);
        foreach($resultats as $resultat){
            $resultat->note_1 = bcdiv($resultat->note_1,1,2);
            $resultat->note_2 = bcdiv($resultat->note_2,1,2);
            $resultat->note_3 = bcdiv($resultat->note_3,1,2);
            $resultat->note_passage = bcdiv($resultat->note_passage,1,2);
        }
        return view('bulletin.rapport.liste_rang_annuel',compact('resultats','classe'));
    }

}

?>