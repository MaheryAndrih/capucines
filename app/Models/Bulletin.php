<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_classe',
        'id_matiere',
        'nom_matiere',
        'matricule',
        'nom',
        'prenom',
        'ds1',
        'ds2',
        'exam',
        'coefficient',
        'moyenne',
        'mc',
        'appreciation',
        'rang',
        'rapportEtudiant',
        'rapportGlobal'
    ];

    public static function getBulletin($idEpreuve, $matricule){
        // Exécuter la requête et obtenir les résultats
        $results = DB::select('SELECT get_bulletin(?, ?)', [$idEpreuve, $matricule]);

        // Vérifiez si des résultats ont été retournés
        if (empty($results)) {
            return []; // Retournez un tableau vide si aucun résultat
        }

        // Créer un tableau pour stocker les bulletins
        $bulletins = [];

        // Parcourir les résultats et créer des objets Bulletin
        foreach ($results as $result) {
            // Récupérer la chaîne de résultats
            $data = $result->get_bulletin;

            // Supprimer les parenthèses et diviser la chaîne
            $data = trim($data, '()');
            $values = explode(',', $data);

            // Assurez-vous que vous avez le bon nombre de valeurs
            if (count($values) < 12) {
                throw new \Exception("Le nombre de valeurs retournées est insuffisant.");
            }

            // Mapper les valeurs à un tableau associatif et ajouter à la liste
            $bulletins[] = new self([
                'id_classe' => trim($values[0]),
                'id_matiere' => trim($values[1]),
                'nom_matiere' => str_replace('"',"",trim($values[2])),
                'matricule' => trim($values[3]),
                'nom' => trim($values[4]),
                'prenom' => trim($values[5]),
                'ds1' => self::replace0ToEmpty(trim($values[6])),
                'ds2' => self::replace0ToEmpty(trim($values[7])),
                'exam' => self::replace0ToEmpty(trim($values[8])),
                'coefficient' => self::replace0ToEmpty(trim($values[9])),
                'moyenne' => self::replace0ToEmpty(bcdiv(trim($values[10]),1,2)),
                'mc' => self::replace0ToEmpty(bcdiv(trim($values[11]),1,2)),
                'appreciation' => self::getAppreciation(bcdiv(trim($values[10]),1,2)),
                'rang' => self::getRang(trim($values[0]),trim($values[1]),$idEpreuve,trim($values[3]),trim($values[10])),
                'rapportEtudiant' => self::getRapportEtudiantPeriode(trim($values[0]),$idEpreuve,trim($values[3])),
                'rapportGlobal' => self::getRapportGlobal(trim($values[0]),$idEpreuve)
            ]);
        }

        // Retourner le tableau de bulletins
        return $bulletins;
    }

    public static function getAppreciation($moyenne){
        $apprecitation = DB::select('SELECT appreciation FROM appreciation WHERE debut <= CAST(? AS NUMERIC) AND fin >= CAST(? AS NUMERIC)', [$moyenne, $moyenne]);
        $valeurAppreciation = $apprecitation[0]->appreciation;
        if($moyenne == 0){
            return '';
        }
        return $valeurAppreciation;
    }

    public static function getRang($id_classe,$id_matiere,$id_epreuve,$matricule,$moyenne){
        if($moyenne == 0){
            return '';
        }
        $rang = DB::select("SELECT rang FROM f_rapport_matiere(?,?,?) WHERE matricule = ?" ,[$id_classe,$id_matiere,$id_epreuve,$matricule]);
        return $rang[0]->rang;
    }

    public static function getRapportEtudiantPeriode($id_classe,$id_epreuve_mere,$matricule){
        $result = DB::select("SELECT * FROM f_rapport_etudiant_periode(?,?) WHERE matricule = ?" ,[$id_classe,$id_epreuve_mere,$matricule]);
        $result[0]->moyenne = bcdiv($result[0]->moyenne,1, 2);
        $result[0]->total_note = bcdiv($result[0]->total_note,1, 2);
        return $result[0];
    }

    public static function getRapportGlobal($id_classe,$id_epreuve_mere){
        $result = DB::select("SELECT * FROM f_rapport_global(?,?)" ,[$id_classe,$id_epreuve_mere]);
        $result[0]->moyenne_classe =  bcdiv($result[0]->moyenne_classe,1, 2);
        return $result[0];
    }

    public static function replace0ToEmpty($value){
        if($value == 0){
            return '';
        }
        return $value;
    }
}
