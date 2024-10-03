<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\VEleve;
use App\Models\Eleve;
use App\Models\ClasseEleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EleveController extends Controller{

    public function ajouter_eleve(){
        //try{
            //DB::beginTransaction();
            $eleve = Eleve::create([
                'nom'=>request('nom'),
                'prenom'=>request('prenom'),
                'dtn'=>request('dtn'),
                'genre'=>request('genre'),
                'nom_pere'=>request('nom_pere'),
                'profession_pere'=>request('profession_pere'),
                'numero_pere'=>request('numero_pere'),
                'nom_mere'=>request('nom_mere'),
                'profession_mere'=>request('profession_mere'),
                'numero_mere'=>request('numero_mere'),
            ]);
            $eleve_classe = ClasseEleve::create([
                'id_classe'=>request('id_classe'),
                'matricule'=>$eleve->matricule,
                'numero'=>request('numero')
            ]);
        /*} catch(\Exception $e) {
            //DB::rollBack();
            return $this->to_ajout_eleve($e->getMessage());
        }*/
        return $this->to_ajout_eleve();
    }

    public function to_ajout_eleve($erreur=null){
        $classes = Classe::all();
        $erreur = $erreur ?? "";
        return view('eleve.ajout_eleve',compact('classes','erreur'));
    }

    public function to_eleve_classe(){
        $classes = Classe::all();
        return view('eleve.select_eleve_classe',compact('classes'));
    }

    public function select_eleve_classe(){
        $id_classe = request('id_classe');
        $classe = Classe::find($id_classe);
        $eleves = VEleve::where('id_classe',$id_classe)->get();
        return view('eleve.liste_eleve_classe',compact('eleves','id_classe','classe'));
    }

    public function search_eleve_class(){
        $search = request('search');
        $id_classe = request('id_classe');
        $classe = Classe::find($id_classe);
        $eleves = [];
        if($search==""){
            $eleves = VEleve::where('id_classe',$id_classe)
            ->get();
        } else {
            $eleves = VEleve::where('id_classe', $id_classe)
                ->where(function($query) use ($search) {
                    $query->whereRaw('LOWER(nom) like ?', ['%' . strtolower($search) . '%'])
                        ->orWhereRaw('LOWER(prenom) like ?', ['%' . strtolower($search) . '%']);
                })
                ->get();
        }
        return view('eleve.liste_eleve_classe',compact('eleves','id_classe','classe'));
    }

    public function to_eleve(){
        $eleves = Eleve::all();
        return view('eleve.liste_eleve',compact('eleves'));
    }

    public function to_profil_eleve(){
        $eleve = VEleve::find(request('matricule'));
        return view('eleve.profil',compact('eleve'));
    }

}

?>