<?php

namespace App\Http\Controllers;

use App\Models\ImportClasseEleve;
use App\Models\ImportNote;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Sabberworm\CSS\Property\Import;

class ClasseEleveController extends Controller
{
    //
    public function doImport(Request $request)
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

                DB::beginTransaction();
                // DB::select('SELECT delete_import_coefficient()');
                while (($line = fgetcsv($handle))!== FALSE) 
                {
                    $data = array_combine($header, $line);
                    $importClasseEleve = new ImportNote();
                    // $importClasseEleve->numero = $data['N°'];
                    // $importClasseEleve->noms = $data['Noms'];
                    // $importClasseEleve->prenoms = $data['Prénoms'];
                    // $importClasseEleve->sexe = $data['Sexe'];
                    // $importClasseEleve->date_de_naiss = $data['Date de naiss'];
                    // $importClasseEleve->matricule = $data['N°Mat'];
                    // $importClasseEleve->save();
                }
                // $id_classe = $request->input('id_classe');
                // dd($id_classe);
                // DB::select('SELECT delete_coefficient_existant(?)',[$id_classe]);
                // DB::select('SELECT insert_unique_coefficient()');
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
}
