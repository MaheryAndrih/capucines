<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClasseMatiereCoefficient;
use App\Models\ImportCoefficient;
use App\Models\VClasseMatiereCoefficient;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CoefficientController extends Controller
{
    //
    public function choixClasse(){
        $classes = Classe::all();
        return view('administration.coefficient.consulter_coef',['classes' => $classes]);
    }

    public function listeCoefficient(Request $request){
        $id_classe = $request->input('id_classe');
        $listeCoefficient = VClasseMatiereCoefficient::where('id_classe',$id_classe)->get();
        $classe = null;
        if(count($listeCoefficient) > 0){
            $id_classe = $listeCoefficient[0]->id_classe;
            $classe = Classe::select('code_classe')->where('id_classe',$id_classe)->first();
        }
        return view('administration.coefficient.liste_coefficient',[
            'listeCoefficient' => $listeCoefficient,
            'id_classe' => $id_classe,
            'classe' => $classe
        ]);
    }

    public function update(Request $request){
        DB::table('classe_matiere_coefficient')
            ->where('id_classe',$request->input('id_classe'))
            ->where('id_matiere',$request->input('id_matiere'))
            ->update(['coefficient' => $request->input('coefficient')]);
        return redirect()->back();
    }

    public function delete(Request $request){
        DB::table('classe_matiere_coefficient')
            ->where('id_classe',$request->input('id_classe'))
            ->where('id_matiere',$request->input('id_matiere'))
            ->delete();
        return redirect()->back();
    }

    public function showImport(){
        $classes = Classe::select('id_classe','code_classe')->get();
        return view('administration.coefficient.import',['classes' => $classes]);
    }
    
    public function import(Request $request)
    {
        //verifier si le request a un fichier
        if ($request->hasFile('file'))
        {
            try
            {
                //verifier si le Model reference a importer present dans le Model
                self::verifyCsvFile($request->file('file'));
                self::verifyModel($request->input('model'));
                $attributes = self::getMassAssignableAttributes($request->input('model')); 
                $file = $request->file('file');
                $handle = fopen($file->getRealPath(), "r");
                $header = fgetcsv($handle);
                // dd($attributes);
                self::arraysAreIdentical($header,$attributes);

                DB::beginTransaction();
                DB::select('SELECT delete_import_coefficient()');
                while (($line = fgetcsv($handle))!== FALSE) 
                {
                    $data = array_combine($header, $line);
                    // dd($data);
                    $importCoefficient = new ImportCoefficient();
                    $importCoefficient->code_classe = $data['code_classe'];
                    $importCoefficient->code_matiere = $data['code_matiere'];
                    $importCoefficient->coefficient = str_replace(",",".",$data['coefficient']);
                    $importCoefficient->save();
                }
                $id_classe = $request->input('id_classe');
                // dd($id_classe);
                DB::select('SELECT delete_coefficient_existant(?)',[$id_classe]);
                DB::select('SELECT insert_unique_coefficient()');
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
