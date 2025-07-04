<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ClasseEleveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




require __DIR__.'/authentification/login/login.php';
require __DIR__.'/note/note.php';
require __DIR__.'/coefficient/coefficient.php';
require __DIR__.'/import/import.php';
require __DIR__.'/export/export.php';


Route::get('/to_liste_utilisateur', [UtilisateurController::class, 'to_liste_utilisateur']);
Route::post('/addUtilisateur', [UtilisateurController::class, 'addUtilisateur']);
Route::post('/editUtilisateur', [UtilisateurController::class, 'editUtilisateur']);
Route::post('/deleteUtilisateur', [UtilisateurController::class, 'deleteUtilisateur']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/to_generer_bulletin', [BulletinController::class, 'to_generer_bulletin']);
Route::post('/genererBulletin', [BulletinController::class, 'genererBulletin']);
Route::get('/to_rang_matiere', [BulletinController::class, 'to_rang_matiere']);
Route::post('/select_rapport_matiere', [BulletinController::class, 'select_rapport_matiere']);
Route::get('/to_rang_examen', [BulletinController::class, 'to_rang_examen']);
Route::post('/select_rapport_examen', [BulletinController::class, 'select_rapport_examen']);
Route::get('/to_rang_annuel', [BulletinController::class, 'to_rang_annuel']);
Route::get('/select_rapport_annuel', [BulletinController::class, 'select_rapport_annuel']);

Route::get('/to_ajout_eleve', [EleveController::class, 'to_ajout_eleve']);
Route::get('/to_eleve_classe', [EleveController::class, 'to_eleve_classe']);
Route::get('/select_eleve_classe', [EleveController::class, 'select_eleve_classe']);
Route::post('/search_eleve_class', [EleveController::class, 'search_eleve_class']);
Route::get('/to_eleve', [EleveController::class, 'to_eleve']);
Route::get('/to_profil_eleve/{matricule}', [EleveController::class, 'to_profil_eleve']);
Route::post('/ajouter_eleve', [EleveController::class, 'ajouter_eleve']);
Route::post('/deleteEleveClasse', [EleveController::class, 'deleteEleveClasse']);
Route::post('/modifier_eleve_info1', [EleveController::class, 'modifier_eleve_info1']);
Route::post('/modifier_eleve_info2', [EleveController::class, 'modifier_eleve_info2']);
Route::post('/add_sanction', [EleveController::class, 'add_sanction']);
Route::post('/deleteSanction', [EleveController::class, 'deleteSanction']);

Route::get('to_create_csv',[NoteController::class,'to_create_csv']);
Route::post('search_eleve_note',[NoteController::class,'search_eleve_note']);

Route::post('/importClasseEleve', [ClasseEleveController::class, 'importClasseEleve']);
