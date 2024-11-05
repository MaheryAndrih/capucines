<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ImportClasseEleve;
use App\Models\ImportEleveTemporaire;
use App\Models\ImportNote;
use App\Models\VEleve;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Sabberworm\CSS\Property\Import;
use Symfony\Component\Routing\Loader\Configurator\ImportConfigurator;

class ClasseEleveController extends Controller
{
    //
    public function importClasseEleve(Request $request)
    {
        //verifier si le request a un fichier
        if ($request->hasFile('file'))
        {
            try
            {
                //verifier si le Model reference a importer present dans le Model
                self::verifyCsvFile($request->file('file'));
                self::verifyModel($request->input('model'));
                $file = $request->file('file');
                $handle = fopen($file->getRealPath(), "r");
                $header = fgetcsv($handle);
                if (isset($header[0])) {
                    $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);
                }
                $id_classe = request('id_classe');
                self::checkFileName($id_classe,$file);
                // dd($id_classe);
                DB::beginTransaction();
                DB::select('SELECT delete_import_eleve_temporaire()');
                while (($line = fgetcsv($handle))!== FALSE) 
                {
                    $data = array_combine($header, $line);
                    $importClasseEleve = new ImportEleveTemporaire();
                    $importClasseEleve->numero = $data['N°'];
                    $importClasseEleve->noms = $data['Noms'];
                    $importClasseEleve->prenoms = $data['Prénoms'];
                    $importClasseEleve->genre = $data['Sexe'];
                    $importClasseEleve->dtn = $data['Date de naiss'];
                    $importClasseEleve->matricule = $data['N°Mat'];
                    $importClasseEleve->save();
                }
                DB::select('SELECT delete_classe_eleve(?)',[$id_classe]);
                DB::select('SELECT insert_unique_eleve()');
                DB::select('SELECT insert_unique_eleve_classe(?)',[$id_classe]);
                DB::commit();
                fclose($handle);
                return redirect()->back()->with('success'.$request->input('model'), 'Aucune anomalie touve');
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
            catch(\InvalidArgumentException $ie)
            {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $ie->getMessage()]);
            }
            finally{
                DB::commit();
            }
        }
        return redirect()->back()->withErrors(['error' => 'veuillez selectionne un fichier']);
    }

    //verification si le model donne en parametre existe
    public static function verifyModel($modelName)
    {
        $modelClass = "App\\Models\\" . $modelName;
    
        if (class_exists($modelClass)) {
            return true;
        }
        throw new \Exception('le Model "'.$modelName.'" n \'existe pas');
    }

    //verification si le fichier est un fichier csv 
    public static function verifyCsvFile(UploadedFile $file)
    {
        if ($file->getClientOriginalExtension() === 'csv') 
        {
            return true;
        }
        throw new \Exception('le fichier doit etre un fichier csv');
    }

    //getter tous les attributs masse assignable d'un model donne
    public static function getMassAssignableAttributes(string $modelName): array
    {
        $modelClass = "App\\Models\\" . $modelName;
        // Instancier le modèle
        $model = new $modelClass;

        // Vérifier si le modèle utilise le trait HasFactory
        if (!method_exists($model, 'getFillable')) {
            throw new \InvalidArgumentException("The model class {$modelName} does not have fillable attributes.");
        }

        // Récupérer les attributs fillable
        return $model->getFillable();
    }

    //comparaison de deux tableau de string
    public static function arraysAreIdentical(array $array1, array $array2): bool
    {
        // Compare les deux tableaux
        $diff = array_diff($array1, $array2);
        $count_diff = count($diff);
        // Retourne vrai si aucun élément ne diffère
        if($count_diff != 0)
        {
            throw new \InvalidArgumentException("La premiere ligne du fichier csv n'est pas identique au model de reference");
        }
        return true;
    }

    public static function checkFileName($id_classe,UploadedFile $file){
        $file_name = $file->getClientOriginalName();
        $fileNameWithoutExtension = pathinfo($file_name, PATHINFO_FILENAME);
        $classe = Classe::select('code_classe')->where('id_classe',$id_classe)->first();
        if($fileNameWithoutExtension != $classe['code_classe']){
            throw new \InvalidArgumentException("Fichier invalide : le nom du fichier doit etre ".$classe['code_classe'].".csv");
        }
        return true;
    }
}
