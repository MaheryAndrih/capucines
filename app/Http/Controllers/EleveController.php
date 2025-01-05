<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\VEleve;
use App\Models\Eleve;
use App\Models\Sanction;
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
        $classes = Classe::orderBy('id_classe')->get();
        return view('eleve.select_eleve_classe',compact('classes'));
    }

    public function select_eleve_classe(){
        $id_classe = request('id_classe');
        $classe = Classe::find($id_classe);
        $eleves = VEleve::where('id_classe',$id_classe)
        ->OrderBy('numero')->get();
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
        $eleves = VEleve::all();
        return view('eleve.liste_eleve',compact('eleves'));
    }

    public function to_profil_eleve(){
        $eleve = VEleve::find(request('matricule'));
        $sanctions = Sanction::where('matricule',request('matricule'))->get();
        return view('eleve.profil',compact('eleve','sanctions'));
    }

    public function deleteEleveClasse(){
        $eleve = ClasseEleve::where('matricule',request('matricule'))->delete();
        return redirect()->back();
    }

    public function modifier_eleve_info1(){
        $el = Eleve::find(request('matricule'));
        $el->nom=request('nom');
        $el->prenom=request('prenom');
        $el->dtn=request('dtn');
        $el->genre=request('genre');
        $el->save();
        $eleve = VEleve::find(request('matricule'));
        $sanctions = Sanction::where('matricule',request('matricule'))->get();
        return view('eleve.profil',compact('eleve','sanctions'));
    }

    public function modifier_eleve_info2(){
        $el = Eleve::find(request('matricule'));
        $el->nom_pere=request('nom_pere');
        $el->profession_pere=request('profession_pere');
        $el->numero_pere=request('numero_pere');
        $el->nom_mere=request('nom_mere');
        $el->profession_mere=request('profession_mere');
        $el->numero_mere=request('numero_mere');
        $el->save();
        $eleve = VEleve::find(request('matricule'));
        $sanctions = Sanction::where('matricule',request('matricule'))->get();
        return view('eleve.profil',compact('eleve','sanctions'));
    }

    public function add_sanction(){
        $data['matricule'] = request('matricule');
        $data['motif'] = request('motif');
        $sanction = new Sanction();
        $sanction->store($data);
        $eleve = VEleve::find(request('matricule'));
        $sanctions = Sanction::where('matricule',request('matricule'))->get();
        return view('eleve.profil',compact('eleve','sanctions'));
    }

    public function deleteSanction(){
        $sanction = Sanction::find(request('sanction'))->delete();
        $eleve = VEleve::find(request('matricule'));
        $sanctions = Sanction::where('matricule',request('matricule'))->get();
        return view('eleve.profil',compact('eleve','sanctions'));
    }

}

?>