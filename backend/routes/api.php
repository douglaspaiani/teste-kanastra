<?php

use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Listagem de boletos
Route::get('/list', [\App\Http\Controllers\UploadController::class, 'listUploads']);
// Upload de CSV
Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'uploadCsv']);
// Botão de disparo manual de boletos
Route::get('/boletos', [\App\Http\Controllers\UploadController::class, 'processarBoletos']);