<?php

use App\Http\Controllers\ClasseEleveController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => ImportController::class,
    'prefix' => 'import',
    'as' => 'import.',
    ],function() {
    Route::get('showImport', 'showImport')->name('showImport');
});

Route::group([
    'controller' => ClasseEleveController::class,
    'prefix' => 'classeEleve',
    'as' => 'classeEleve.',
    ],function() {
    Route::POST('importClasseEleve', 'importClasseEleve')->name('importClasseEleve');
});

