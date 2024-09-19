<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => NoteController::class,
    'prefix' => 'note',
    'as' => 'note.',
    ],function() {
    Route::get('selection', 'selection')->name('selection');
    Route::post('updateOrInsertNote','updateOrInsertNote')->name('updateOrInsertNote');
    Route::post('delete','delete')->name('delete');
    Route::get('selection', 'selection')->name('selection');
});