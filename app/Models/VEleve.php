<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VEleve extends Objet
{
    use HasFactory;

    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenom','dtn','genre','nom_pere','profession_pere','numero_pere','nom_mere','profession_mere','numero_mere','id_classe','nom_classe','numero','image'];
    protected $table = 'v_eleve';

    public function getNote($epreuve,$id_matiere){
        $note = VNoteClasse::where('id_classe',$this->id_classe)
            ->where('id_matiere',$id_matiere)
            ->where('id_epreuve',$epreuve)
            ->where('matricule',$this->matricule)
            ->orderBy('numero')
            ->get();
        return $note[0]->note;
    }

    public function getMoyenneMatiere($epreuves,$id_matiere){
        $somme = 0;
        $diviser = 0;
        foreach($epreuves as $epreuve){
            $somme = $somme + $this->getNote($epreuve->id_epreuve,$id_matiere);
            $diviser = $diviser + Note::where('id_classe',$this->id_classe)
                ->where('id_matiere',$id_matiere)
                ->where('id_epreuve',$epreuve->id_epreuve)
                ->where('matricule',$this->matricule)
                ->count();
        }
        if($diviser==0){
            return $somme;
        }
        return $somme/$diviser;
    }

    public function getMoyenne($epreuves){
        $somme = 0;
        $matieres = ClasseMatiereCoefficient::where('id_classe',$this->id_classe);
        var_dump($matieres);
        /*foreach($matieres as $matiere){

        }*/
        //return $somme;
    }
    
    public function getDtnAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y'); // Formate la date au format jour/mois/année
    }   
}