<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\VNoteClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Note as PromptsNote;

class NoteController extends Controller
{
    //
    public function selection(Request $request){
        $id_classe = $request->input('id_classe');
        $id_matiere = $request->input('id_matiere');
        $id_epreuve = $request->input('id_epreuve');
        $notes = VNoteClasse::
            where('id_classe',$id_classe)
            ->where('id_matiere',$id_matiere)
            ->where('id_epreuve',$id_epreuve)->get();
        return view('note.listeNote',
            [ 
                'notes' => $notes 
            ]
        );
    }

    public static function update($requestVariable){
        DB::table('note')->
            where('id_classe',$requestVariable['id_classe'])
            ->where('id_eleve',$requestVariable['id_eleve'])
            ->where('id_matiere',$requestVariable['id_matiere'])
            ->where('id_epreuve',$requestVariable['id_epreuve'])
            ->update(['note' => $requestVariable['note']]);
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
        ->where('id_eleve',$requestVariable['id_eleve'])
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
}
