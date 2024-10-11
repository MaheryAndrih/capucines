<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Epreuve;
use App\Models\VEleve;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    //
    public function apercu(Request $request){
        $eleve = VEleve::where('matricule',$request->input('matricule'))->first();
        $epreuve = Epreuve::where('id_epreuve',$request->input('id_epreuve'))->first();
        $data = [ 
            "eleve" => $eleve,
            "epreuve" => $epreuve
        ];
        $pdf = Pdf::loadView('export.apercu',$data);
        return $pdf->stream();
    }

    public function generer(Request $request){
        $classe = Classe::where('id_classe',$request->input('id_classe'))->first();
        $epreuve = Epreuve::where('id_epreuve',$request->input('id_epreuve'))->first();
        $eleves = VEleve::where('id_classe', $classe->id_classe)->orderBy('numero')->get();
        $zipFileName = $classe['nom_classe'].'_'.$epreuve['code_epreuve'].'.zip';
        $zipFilePath = storage_path($zipFileName);

        // Créer une instance de ZipArchive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($eleves as $eleve){
                $filePath = $this->saveBulletin($eleve,$classe,$epreuve);
                $zip->addFile($filePath, basename($filePath));
            }
            $zip->close();
        }

        // Télécharger le fichier ZIP
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    private function saveBulletin($eleve,$classe,$epreuve){
        $data = [
            "eleve" => $eleve,
            "epreuve" => $epreuve
        ];
        $pdf = Pdf::loadView('export.apercu', $data);
        $filePath = storage_path("app/public/bulletins/{$eleve->numero}_{$eleve->prenom}_{$classe['nom_classe']}_{$epreuve['code_epreuve']}.pdf");

        // Créer le dossier si nécessaire
        Storage::makeDirectory('public/'.$classe['nom_classe'].'_'.$epreuve['code_epreuve']);

        // Enregistrer le fichier PDF
        $pdf->save($filePath);

        return $filePath;
    }
}
