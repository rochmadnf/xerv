<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Console, Auth};


Route::controller(Auth\LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Auth\LogoutController::class)->name('logout');

    Route::prefix('console')->group(function () {
        Route::get('/', [Console\DashboardController::class, 'index'])->name('console.dashboard');

        Route::prefix('files')->group(function () {
            Route::controller(Console\UploadFileController::class)->group(function () {
                Route::get('/{file_type}', 'index')->name('files.index');
                Route::get('{file_type}/create', 'create')->name('files.create');
            });

            Route::controller(Console\File\AkipController::class)->prefix('akip')->group(function () {
                Route::post('/store', 'store')->name('files.akip.store');
                Route::get('/{id}/edit', 'edit')->name('files.akip.edit');
                Route::get('/{id}/edit-file', 'editFile')->name('files.akip.edit.file');
                Route::put('/{id}/update', 'update')->name('files.akip.update');
                Route::put('/{id}/update-file', 'updateFile')->name('files.akip.update.file');
                Route::delete('/{id}/delete', 'destroy')->name('files.akip.destroy');
            });
        });
    });
});
