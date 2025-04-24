<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;



Route::get('/', [FileUploadController::class, 'index'])->name('upload.form');
Route::post('/upload', [FileUploadController::class, 'store'])->name('upload.submit');
Route::get('/file/{uuid}', [FileUploadController::class, 'preview'])->name('preview');
Route::get('/download/{uuid}', [FileUploadController::class, 'download'])->name('download');