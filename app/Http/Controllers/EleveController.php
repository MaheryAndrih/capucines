<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\VEleve;
use App\Models\Eleve;
use Illuminate\Http\Request;

class EleveController extends Controller{

    public function to_ajout_eleve(){
        return view('eleve.ajout_eleve');
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