<?php

use Illuminate\Support\Facades\Route;
// se importa la clase controladora
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing/index');
})->name('/');

Route::get('/backoffice/login', [UserController::class, 'showFormLogin'])->name('user.form.show.login');
Route::post('/backoffice/login', [UserController::class, 'login'])->name('user.form.login');

Route::get('/backoffice/create-user', [UserController::class, 'showFormRegistro'])->name('user.form.show.registro');
Route::post('/backoffice/create-user', [UserController::class, 'guardarNuevo'])->name('user.form.registro');

Route::post('/backoffice/logout', [UserController::class, 'logout'])->name('logout');

