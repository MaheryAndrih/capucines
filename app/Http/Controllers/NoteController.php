<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClasseEleve;
use App\Models\Epreuve;
use App\Models\ImportNote;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\VClasseMatiereCoefficient;
use App\Models\VEpreuve;
use App\Models\VNoteClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class NoteController extends Controller
{
    //
    public function selection(Request $request){
        $id_classe = $request->input('id_classe');
        $id_matiere = $request->input('id_matiere');
        $id_epreuve = $request->input('id_epreuve');
        $nom_classe = Classe::select('nom_classe')->where('id_classe',$id_classe)->first();
        $nom_matiere = Matiere::select('nom_matiere')->where('id_matiere',$id_matiere)->first();
        $nom_epreuve = Epreuve::select('nom_epreuve')->where('id_epreuve',$id_epreuve)->first();
        $nbr_eleve = ClasseEleve::where('id_classe', $id_classe)->count();
        $notes = VNoteClasse::where('id_classe',$id_classe)
            ->where('id_matiere',$id_matiere)
            ->where('id_epreuve',$id_epreuve)
            ->OrderBy('numero')
            ->get();
        $moyenne = DB::select('SELECT get_moyenne_matiere(?,?,?)',[$id_classe,$id_matiere,$id_epreuve]);
        $moyenne_value = $moyenne[0]->get_moyenne_matiere;
        $moyenne_value = round($moyenne_value, 2);
        return view('note.listeNote',
            [ 
                'notes' => $notes,
                'id_classe' => $id_classe,
                'id_epreuve' => $id_epreuve,
                'id_matiere' => $id_matiere,
                'nom_classe' => $nom_classe,
                'nom_matiere' => $nom_matiere,
                'nom_epreuve' => $nom_epreuve,
                'nbr_eleve' => $nbr_eleve,
                'moyenne' => $moyenne_value 
            ]
        );
    }

    public static function update($requestVariable){
        DB::table('note')->
            where('id_classe',$requestVariable['id_classe'])
            ->where('matricule',$requestVariable['id_eleve'])
            ->where('id_matiere',$requestVariable['id_matiere'])
            ->where('id_epreuve',$requestVariable['id_epreuve'])
            ->update(['note' => doubleval($requestVariable['note'])]);
    }

    public static function insert($requestVariable){
        $note = new Note();
        $note->store($requestVariable);
    }

    public function updateOrInsertNote(Request $request){
        $requestVariable = 
            [
                'id_classe' => $request->input('id_classe'),
                'id_eleve' => $request->input('id_eleve'),
                'id_epreuve' => $request->input('id_epreuve'),
                'id_matiere' => $request->input('id_matiere'),
                'note' => $request->input('new_note')
            ]
        ;
        $note = Note::
         where('id_classe',$requestVariable['id_classe'])
        ->where('matricule',$requestVariable['id_eleve'])
        ->where('id_matiere',$requestVariable['id_matiere'])
        ->where('id_epreuve',$requestVariable['id_epreuve'])
        ->first();
        
        if($note){
            self::update($requestVariable);
            return redirect()->back();
        }
        self::insert($requestVariable);
        return redirect()->back();
    }

    public function delete(Request $request){
        Note::where('id_classe',$request->input('id_classe'))
        ->where('id_matiere',$request->input('id_matiere'))
        ->where('id_epreuve',$request->input('id_epreuve'))
        ->delete();

        return redirect()->back();
    }

    public function ajout(){
        $classes = Classe::all();
        $idClasseSelectionnee = $classes->first()->id_classe;

        // Récupérer les matières correspondant à la classe sélectionnée
        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)
                ->select('id_matiere', 'nom_matiere')
                ->get();

        $epreuves = VEpreuve::where('id_classe', $idClasseSelectionnee)
            ->select('id_epreuve', 'code_epreuve')
            ->get();
        return view('note.ajoutNote',
            [
                'classes' => $classes,
                'matieres' => $matieres,
                'epreuves' => $epreuves,
            ]
        );
    }

    public function import(Request $request)
    {
        //verifier si le request a un fichier
        if ($request->hasFile('file'))
        {
            try
            {
                $id = $request->only(['id_classe','id_matiere','id_epreuve']);
                //verifier si le Model reference a importer present dans le Model
                self::verifyCsvFile($request->file('file'));
                // self::checkLibelleCompatibility($id,$request->file('file'));
                self::verifyModel($request->input('model'));
                $attributes = self::getMassAssignableAttributes($request->input('model')); 

                $file = $request->file('file');
                self::getOriginalFileName($id,$file);
                $handle = fopen($file->getRealPath(), "r");
                $header = fgetcsv($handle);
                if (isset($header[0])) {
                    $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);
                }
                self::getOriginalFileName($id,$file);
                // self::arraysAreIdentical($header,$attributes);
                DB::beginTransaction();
                DB::select('SELECT delete_import_note()');
                while (($line = fgetcsv($handle))!== FALSE) 
                {
                    $data = array_combine($header, $line);
                    $importNote = new ImportNote;
                    $importNote->code_epreuve = $data['code_epreuve'];
                    $importNote->code_classe = $data['code_classe'];
                    $importNote->code_matiere = $data['code_matiere'];
                    $importNote->matricule = $data['matricule'];
                    $importNote->nom = $data['nom'];
                    $importNote->prenom = $data['prenom'];
                    $importNote->note = str_replace(",",".",$data['note']);
                    $importNote->save();
                }
                DB::select('SELECT delete_note_existant(?,?,?)',[$id['id_epreuve'],$id['id_classe'],$id['id_matiere']]);
                DB::select('SELECT insert_unique_note()');
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

    public static function getOriginalFileName($id_data,UploadedFile $file){
        $file_name = $file->getClientOriginalName();
        $file_name = explode('_',$file_name);
        // dd($file_name[0]);
        $epreuve = Epreuve::select('code_epreuve')->where('id_epreuve',$id_data['id_epreuve'])->first();
        $classe = Classe::select('code_classe')->where('id_classe',$id_data['id_classe'])->first();
        $matiere = Matiere::select('code_matiere','nom_matiere')->where('id_matiere',$id_data['id_matiere'])->first();
        if($file_name[0] != $epreuve['code_epreuve']){
            throw new \InvalidArgumentException("Fichier invalide : le nom du fichier doit etre ". $epreuve['code_epreuve']."_".$classe['code_classe']."_".$matiere['code_matiere']."_".$matiere['nom_matiere'].".csv");
        }
        if($file_name[1] != $classe['code_classe']){
            throw new \InvalidArgumentException("Fichier invalide : le nom du fichier doit etre ". $epreuve['code_epreuve']."_".$classe['code_classe']."_".$matiere['code_matiere']."_".$matiere['nom_matiere'].".csv");
        }
        return true;
    }

    public static function checkLibelleCompatibility($id,UploadedFile $file){
        $fileName = $file->getClientOriginalName();
        $fileName = explode('_',$fileName);
        dd($fileName);
    }

    public function to_create_csv(){
        $classes = Classe::all();
        $idClasseSelectionnee = request('id_classe') ?? $classes->first()->id_classe;
        $matieres = VClasseMatiereCoefficient::where('id_classe', $idClasseSelectionnee)->get();
        $epreuves = VEpreuve::where('id_classe', $idClasseSelectionnee)->get();
        return view('note.createCSV',compact('classes','matieres','epreuves'));
    }

    public function search_eleve_note(){
        $search = request('search');
        $id_classe = request('id_classe');
        $id_matiere = request('id_matiere');
        $id_epreuve = request('id_epreuve');
        $notes = VNoteClasse::
            where('id_classe',$id_classe)
            ->where('id_matiere',$id_matiere)
            ->where('id_epreuve',$id_epreuve)
            ->where(function($query) use ($search) {
                $query->whereRaw('LOWER(nom) like ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(prenom) like ?', ['%' . strtolower($search) . '%']);
            })
            ->OrderBy('matricule')
            ->get();
        return view('note.listeNote',
            [ 
                'notes' => $notes,
                'id_classe' => $id_classe,
                'id_epreuve' => $id_epreuve,
                'id_matiere' => $id_matiere
            ]
        );
    }
}
