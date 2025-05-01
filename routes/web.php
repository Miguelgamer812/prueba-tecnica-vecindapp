<?php

use App\Http\Controllers\PreguntasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/preguntas/create', [PreguntasController::class, 'create'])->name('preguntas.create');
Route::post('/preguntas', [PreguntasController::class, 'store'])->name('preguntas.store');
Route::get('/preguntas/index', [PreguntasController::class, 'index'])->name('preguntas.index');