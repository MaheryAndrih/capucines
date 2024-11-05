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
        'appreciation'
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
                'nom_matiere' => trim($values[2]),
                'matricule' => trim($values[3]),
                'nom' => trim($values[4]),
                'prenom' => trim($values[5]),
                'ds1' => trim($values[6]),
                'ds2' => trim($values[7]),
                'exam' => trim($values[8]),
                'coefficient' => trim($values[9]),
                'moyenne' => round(trim($values[10]),2),
                'mc' => round(trim($values[11]),2),
                'appreciation' => self::getAppreciation(round(trim($values[10]),2))
            ]);
        }

        // Retourner le tableau de bulletins
        return $bulletins;
    }

    public static function getAppreciation($moyenne){
        $apprecitation = DB::select('SELECT appreciation FROM appreciation WHERE debut <= CAST(? AS NUMERIC) AND fin > CAST(? AS NUMERIC)', [$moyenne, $moyenne]);
        $valeurAppreciation = $apprecitation[0]->appreciation;
        return $valeurAppreciation;
    }

}
