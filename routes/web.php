<?php

use App\Http\Controllers\CamisetasController;
use App\Http\Controllers\CargosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecintosController;
use App\Http\Controllers\RolesController;

Route::get('/', function () {
    return view('landing/index');
})->name('/');

Route::get('/backoffice', [DashboardController::class, 'index'])->name('backoffice.dashboard');

//usuario
Route::get('/backoffice/login', [UserController::class, 'showFormLogin'])->name('user.form.show.login');
Route::post('/backoffice/login', [UserController::class, 'login'])->name('user.form.login');

Route::get('/backoffice/create-user', [UserController::class, 'showFormRegistro'])->name('user.form.show.registro');
Route::post('/backoffice/create-user', [UserController::class, 'guardarNuevo'])->name('user.form.registro');

Route::get('/backoffice/user/profile', [UserController::class, 'showPerfil'])->name('backoffice.user.profile');
Route::get('/backoffice/user/contact', [UserController::class, 'showContacto'])->name('backoffice.user.contact');
Route::get('/backoffice/user/security', [UserController::class, 'showSeguridad'])->name('backoffice.user.security');
Route::post('/backoffice/user/security', [UserController::class, 'cambiarClave'])->name('backoffice.user.security.changePass');

Route::post('/backoffice/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/backoffice/roles', [RolesController::class, 'index'])->name('backoffice.roles.index');
Route::post('/backoffice/roles', [RolesController::class, 'store'])->name('backoffice.roles.new');
Route::post('/backoffice/roles/down/{_id}', [RolesController::class, 'down'])->name('backoffice.roles.down');
Route::post('/backoffice/roles/up/{_id}', [RolesController::class, 'up'])->name('backoffice.roles.up');
Route::post('/backoffice/roles/destroy/{_id}', [RolesController::class, 'destroy'])->name('backoffice.roles.destroy');

Route::get('/backoffice/cargos', [CargosController::class, 'index'])->name('backoffice.cargos.index');
Route::post('/backoffice/cargos', [CargosController::class, 'store'])->name('backoffice.cargos.new');
Route::post('/backoffice/cargos/down/{_id}', [CargosController::class, 'down'])->name('backoffice.cargos.down');
Route::post('/backoffice/cargos/up/{_id}', [CargosController::class, 'up'])->name('backoffice.cargos.up');
Route::post('/backoffice/cargos/destroy/{_id}', [CargosController::class, 'destroy'])->name('backoffice.cargos.destroy');

// Javiera Gonzalez

Route::get('/backoffice/recintos', [RecintosController::class, 'index'])->name('backoffice.recintos.index');
Route::post('/backoffice/recintos', [RecintosController::class, 'store'])->name('backoffice.recintos.new');
Route::post('/backoffice/recintos/down/{_id}', [RecintosController::class, 'down'])->name('backoffice.recintos.down');
Route::post('/backoffice/recintos/up/{_id}', [RecintosController::class, 'up'])->name('backoffice.recintos.up');
Route::post('/backoffice/recintos/destroy/{_id}', [RecintosController::class, 'destroy'])->name('backoffice.recintos.destroy');

// Paula Leon

Route::get('/backoffice/camisetas', [CamisetasController::class, 'index'])->name('backoffice.camisetas.index');
Route::post('/backoffice/camisetas', [CamisetasController::class, 'store'])->name('backoffice.camisetas.new');
Route::post('/backoffice/camisetas/down/{_id}', [CamisetasController::class, 'down'])->name('backoffice.camisetas.down');
Route::post('/backoffice/camisetas/up/{_id}', [CamisetasController::class, 'up'])->name('backoffice.camisetas.up');
Route::post('/backoffice/camisetas/destroy/{_id}', [CamisetasController::class, 'destroy'])->name('backoffice.camisetas.destroy');