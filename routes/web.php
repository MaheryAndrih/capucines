<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BulletinController;
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

Route::get('/to_liste_utilisateur', [UtilisateurController::class, 'to_liste_utilisateur']);
Route::post('/addUtilisateur', [UtilisateurController::class, 'addUtilisateur']);
Route::post('/editUtilisateur', [UtilisateurController::class, 'editUtilisateur']);
Route::post('/deleteUtilisateur', [UtilisateurController::class, 'deleteUtilisateur']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/to_generer_bulletin', [BulletinController::class, 'to_generer_bulletin']);
Route::post('/genererBulletin', [BulletinController::class, 'genererBulletin']);

Route::get('/to_ajout_eleve', [EleveController::class, 'to_ajout_eleve']);
Route::get('/to_eleve_classe', [EleveController::class, 'to_eleve_classe']);
Route::get('/select_eleve_classe', [EleveController::class, 'select_eleve_classe']);
Route::post('/search_eleve_class', [EleveController::class, 'search_eleve_class']);
Route::get('/to_eleve', [EleveController::class, 'to_eleve']);
Route::get('/to_profil_eleve/{matricule}', [EleveController::class, 'to_profil_eleve']);

Route::post('/importClasseEleve', [ClasseEleveController::class, 'importClasseEleve']);