<?php

use App\Http\Controllers\IkiController;
use Illuminate\Support\Facades\Route;

Route::get('/iki/{id}', [IkiController::class, 'previewFile'])->name('iki.preview');
