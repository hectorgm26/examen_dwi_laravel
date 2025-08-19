<?php

use App\Http\Controllers\CamisetasController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\ComunasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HoraFinController;
use App\Http\Controllers\HorainicioController;
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

// Santos Cruz

Route::get('/backoffice/comunas', [ComunasController::class, 'index'])->name('backoffice.comunas.index');
Route::post('/backoffice/comunas', [ComunasController::class, 'store'])->name('backoffice.comunas.new');
Route::post('/backoffice/comunas/down/{_id}', [ComunasController::class, 'down'])->name('backoffice.comunas.down');
Route::post('/backoffice/comunas/up/{_id}', [ComunasController::class, 'up'])->name('backoffice.comunas.up');
Route::post('/backoffice/comunas/destroy/{_id}', [ComunasController::class, 'destroy'])->name('backoffice.comunas.destroy');

// Jean Doizi

Route::get('/backoffice/horainicio', [HorainicioController::class, 'index'])->name('backoffice.horainicio.index');
Route::post('/backoffice/horainicio', [HorainicioController::class, 'store'])->name('backoffice.horainicio.new');
Route::post('/backoffice/horainicio/down/{_id}', [HorainicioController::class, 'down'])->name('backoffice.horainicio.down');
Route::post('/backoffice/horainicio/up/{_id}', [HorainicioController::class, 'up'])->name('backoffice.horainicio.up');
Route::post('/backoffice/horainicio/destroy/{_id}', [HorainicioController::class, 'destroy'])->name('backoffice.horainicio.destroy');

// Gerard Aliaga

Route::get('/backoffice/horafin', [HoraFinController::class, 'index'])->name('backoffice.horafin.index');
Route::post('/backoffice/horafin', [HoraFinController::class, 'store'])->name('backoffice.horafin.new');
Route::post('/backoffice/horafin/down/{_id}', [HoraFinController::class, 'down'])->name('backoffice.horafin.down');
Route::post('/backoffice/horafin/up/{_id}', [HoraFinController::class, 'up'])->name('backoffice.horafin.up');
Route::post('/backoffice/horafin/destroy/{_id}', [HoraFinController::class, 'destroy'])->name('backoffice.horafin.destroy');

// Miguel Cabello

Route::get('/backoffice/pagos', [PagosController::class, 'index'])->name('backoffice.pagos.index');
Route::post('/backoffice/pagos', [PagosController::class, 'store'])->name('backoffice.pagos.new');
Route::get('/backoffice/pagos/{_id}', [PagosController::class, 'show'])->name('backoffice.pagos.show');
Route::get('/backoffice/pagos/{_id}/edit', [PagosController::class, 'edit'])->name('backoffice.pagos.edit');
Route::post('/backoffice/pagos/down/{_id}', [PagosController::class, 'down'])->name('backoffice.pagos.down');
Route::post('/backoffice/pagos/up/{_id}', [PagosController::class, 'up'])->name('backoffice.pagos.up');
Route::post('/backoffice/pagos/destroy/{_id}', [PagosController::class, 'destroy'])->name('backoffice.pagos.destroy');
