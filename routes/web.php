<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/perfil', function () {return view('web.usuarios.verUsuario');})->name('perfil')->middleware(['auth']);

Route::group(['prefix' => 'usuarios', 'middleware' => 'auth'], function () {
    Route::get('/', [UsuarioController::class, "index"])->name("usuario.index");
    Route::get('/crear', [UsuarioController::class, "create"])->name("usuario.create");
    Route::post('/', [UsuarioController::class, "store"])->name("usuario.store");
    Route::get('/editar/{usuario}', [UsuarioController::class, "edit"])->name("usuario.edit");
    Route::put('/{usuario}', [UsuarioController::class, "update"])->name("usuario.update");
    Route::delete('/{usuario}', [UsuarioController::class, "destroy"])->name("usuario.destroy");
});

Route::group(['prefix' => 'servicios', 'middleware' => 'auth'], function () {
    Route::get('/', [ServicioController::class, "index"])->name("servicio.index");
    Route::post('/', [ServicioController::class, "store"])->name("servicio.store");
    Route::put('/{servicio}', [ServicioController::class, "update"])->name("servicio.update");
    Route::delete('/{servicio}', [ServicioController::class, "destroy"])->name("servicio.destroy");
});