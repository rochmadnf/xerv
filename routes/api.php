<?php

use App\Http\Controllers\Console\UploadFileController;
use App\Http\Controllers\IkiController;
use Illuminate\Support\Facades\Route;

Route::get('/files/{type}/{id}/{action}', [UploadFileController::class, 'actionToFile'])->whereUuid('id')->whereIn('type', ['iki', 'akip'])->whereIn('action', ['download', 'preview']);
Route::get('/iki/{id}', [IkiController::class, 'previewFile'])->name('iki.preview');
Route::get('/iki/{id}/download', [IkiController::class, 'download'])->name('iki.download');
