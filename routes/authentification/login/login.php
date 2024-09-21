<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::group([
    'controller' => LoginController::class,
    'prefix' => 'login',
    'as' => 'login.',
    ],function() {
    Route::get('acceuil', 'acceuil')->name('acceuil');
    Route::get('getMatieres/{idClasse}','getMatieres');
    Route::get('getEpreuves/{idClasse}','getEpreuves');
});