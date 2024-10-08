<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

Route::post('/export/apercu', [ExportController::class, 'apercu'])->name('export.apercu');