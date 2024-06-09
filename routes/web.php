<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\ConductoresController;
use App\Http\Controllers\DocumentosServiciosController;

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
Route::get('/perfil', function () {
    return view('web.usuarios.verUsuario');
})->name('perfil')->middleware(['auth']);

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
    Route::get('/{servicio}/conductores', [ServicioController::class, 'obtenerConductores'])->name('servicio.obtenerConductores');
    Route::get('/{servicio}/vehiculos', [ServicioController::class, 'obtenerVehiculos'])->name('servicio.obtenerVehiculos');
});

Route::group(['prefix' => 'vehiculos', 'middleware' => 'auth'], function () {
    Route::get('/', [VehiculosController::class, "index"])->name("vehiculo.index");
    Route::get('/crear', [VehiculosController::class, "create"])->name("vehiculo.create");
    Route::post('/', [VehiculosController::class, "store"])->name("vehiculo.store");
    Route::get('/vehiculo/{vehiculo}', [VehiculosController::class, "edit"])->name("vehiculo.edit");
    Route::put('/{vehiculo}', [VehiculosController::class, "update"])->name("vehiculo.update");
    Route::delete('/{vehiculo}', [VehiculosController::class, "destroy"])->name("vehiculo.destroy");
});

Route::group(['prefix' => 'conductores', 'middleware' => 'auth'], function () {
    Route::get('/', [ConductoresController::class, "index"])->name("conductor.index");
    Route::get('/crear', [ConductoresController::class, "create"])->name("conductor.create");
    Route::post('/', [ConductoresController::class, "store"])->name("conductor.store");
    Route::get('/conductor/{conductor}', [ConductoresController::class, "edit"])->name("conductor.edit");
    Route::put('/{conductor}', [ConductoresController::class, "update"])->name("conductor.update");
    Route::delete('/{conductor}', [ConductoresController::class, "destroy"])->name("conductor.destroy");
});


Route::group(['prefix' => 'documentos-servicios', 'middleware' => 'auth'], function () {
    Route::get('/{servicio}/documentos-conductores', [DocumentosServiciosController::class, 'listadoDocumentosConductores'])->name('documentosServicios.obtenerConductores');
    Route::get('/{servicio}/documentos-vehiculos', [DocumentosServiciosController::class, 'listadoDocumentosVehiculos'])->name('documentosServicios.obtenerVehiculos');
});
