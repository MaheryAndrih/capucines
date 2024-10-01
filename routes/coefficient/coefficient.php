<?php

use App\Http\Controllers\CoefficientController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => CoefficientController::class,
    'prefix' => 'coefficient',
    'as' => 'coefficient.',
    ],function() {
    Route::get('choixClasse', 'choixClasse')->name('choixClasse');
    Route::get('listeCoefficient', 'listeCoefficient')->name('listeCoefficient');
    Route::post('update', 'update')->name('update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('import', 'import')->name('import');
    Route::get('showImport', 'showImport')->name('showImport');
});