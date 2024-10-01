<?php

namespace App\Http\Controllers;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller{

    public function to_liste_utilisateur(){
        $utilisateurs = Utilisateur::orderBy('id_utilisateur','asc')->get();
        return view('utilisateur.listeUtilisateur',compact('utilisateurs'));
    }

    public function addUtilisateur(){
        $data['username'] = request('username');
        $data['password'] = request('password');
        $user = new Utilisateur();
        $user->store($data);
        return $this->to_liste_utilisateur();
    }

    public function editUtilisateur(){
        $user = Utilisateur::find(request('id_utilisateur'));
        $user->username=request('username');
        $user->password=request('password');
        $user->save();
        return $this->to_liste_utilisateur();
    }

    public function deleteUtilisateur(){
        $ut = Utilisateur::find(request('id_utilisateur'))->delete();
        return $this->to_liste_utilisateur();
    }

}

?>