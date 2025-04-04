<?php

use Illuminate\Support\Facades\Route;
use App\Http\{Controllers, Controllers\Console, Controllers\Auth};

Route::get('/', Controllers\WelcomeController::class)->name('welcome');
Route::prefix('docs')->group(function () {
    Route::get('/iki', Controllers\IkiController::class)->name('docs.iki');
    Route::get('/akip', Controllers\AkipController::class)->name('docs.akip');
});

Route::controller(Auth\LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Auth\LogoutController::class)->name('logout');

    Route::prefix('console')->group(function () {
        Route::get('/', [Console\DashboardController::class, 'index'])->name('console.dashboard');

        Route::prefix('files')->group(function () {
            Route::controller(Console\File\IkiController::class)->prefix('iki')->group(function () {
                Route::get('/', 'index')->name('files.iki.index');
                Route::get('/create', 'create')->name('files.iki.create');
                Route::post('/store', 'store')->name('files.iki.store');
                Route::get('{id}/edit', 'edit')->name('files.iki.edit');
                Route::put('{id}', 'update')->name('files.iki.update');
                Route::delete('{id}', 'destroy')->name('files.iki.destroy');
            });

            Route::controller(Console\UploadFileController::class)->group(function () {
                Route::get('/{file_type}', 'index')->name('files.index');
                Route::get('{file_type}/create', 'create')->name('files.create');
            });


            Route::controller(Console\File\AkipController::class)->middleware('onlyAdmin')->prefix('akip')->group(function () {
                Route::post('/store', 'store')->name('files.akip.store');
                Route::get('/{id}/edit', 'edit')->name('files.akip.edit');
                Route::get('/{id}/edit-file', 'editFile')->name('files.akip.edit.file');
                Route::put('/{id}/update', 'update')->name('files.akip.update');
                Route::put('/{id}/update-file', 'updateFile')->name('files.akip.update.file');
                Route::delete('/{id}/delete', 'destroy')->name('files.akip.destroy');
            });
        });

        Route::controller(Console\UserController::class)->prefix('users')->middleware('onlyAdmin')->group(function () {
            Route::get('/', 'index')->name('console.users');
            Route::post('/order/{id}/update', 'order')->name('console.users.order.update');
            Route::get('/create', 'create')->name('console.users.create');
            Route::post('/store', 'store')->name('console.users.store');
            Route::delete('/{id}/delete', 'destroy')->name('console.users.destroy');
        });

        Route::get('/user/{id}/edit', [Console\UserController::class, 'edit'])->name('console.users.edit');
        Route::post('/user/{id}/update', [Console\UserController::class, 'update'])->name('console.users.update');
        Route::post('/user/{id}/change-password', [Console\UserController::class, 'changePassword'])->name('console.users.change.password');
    });
});
