<?php

use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\userCreateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(auth() ? 'home' : 'login');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/questions/create', [PreguntasController::class, 'create'])->name('preguntas.create');
    Route::post('/questions', [PreguntasController::class, 'store'])->name('preguntas.store');
    Route::get('/questions/index', [PreguntasController::class, 'index'])->name('preguntas.index');
    Route::post('/voto/{id}', [PreguntasController::class, 'vote'])->name('voto.store');
    Route::get('/voto', [PreguntasController::class, 'userVote'])->name('voto.user');
    Route::get('/questions/view', [PreguntasController::class, 'show'])->name('preguntas.show');
    Route::get('/users/create', [userCreateController::class, 'index'])->name('users.create');
    Route::post('/users/create', [userCreateController::class, 'create'])->name('new.users.create');
    
});
