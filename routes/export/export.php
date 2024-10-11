<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

Route::get('/export/apercu', [ExportController::class, 'apercu'])->name('export.apercu');

Route::get('/bulletin/generer', [ExportController::class, 'generer'])->name('bulletin.generer');
