<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgregarVehiculoRequest;
use App\Http\Requests\EditarVehiculoRequest;
use App\Models\Vehiculos;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehiculos = Vehiculos::all();
        return view("web.vehiculos.listadoVehiculo", [
            "vehiculos" => $vehiculos
        ]);
    }

    public function create()
    {
        return view('web.vehiculos.agregarVehiculo');
    }

    public function store(AgregarVehiculoRequest $request)
    {
        $vehiculo = new Vehiculos();
        $vehiculo->tipo_vehiculo = $request->input('tipo_vehiculo');
        $vehiculo->patente = $request->input('patente');
        $vehiculo->marca = $request->input('marca');
        $vehiculo->modelo = $request->input('modelo');
        $vehiculo->combustible = $request->input('combustible');
        $vehiculo->ano = $request->input('ano');
        $vehiculo->traccion = $request->input('traccion');
        $vehiculo->color = $request->input('color');
        $vehiculo->numero_motor = $request->input('numero_motor');
        $vehiculo->numero_chasis = $request->input('numero_chasis');
        $vehiculo->kilometraje = $request->input('kilometraje');
        $vehiculo->save();

        return response()->json($vehiculo);
    }

    public function edit($id)
    {
        $vehiculo = Vehiculos::findOrFail($id);

        return view('web.vehiculos.editarVehiculo', [
            "vehiculo" => $vehiculo
        ]);
    }

    public function update(EditarVehiculoRequest $request, $id)
    {
        $vehiculo = Vehiculos::findOrFail($id);
        $vehiculo->tipo_vehiculo = $request->input('tipo_vehiculo');
        $vehiculo->patente = $request->input('patente');
        $vehiculo->marca = $request->input('marca');
        $vehiculo->modelo = $request->input('modelo');
        $vehiculo->combustible = $request->input('combustible');
        $vehiculo->ano = $request->input('ano');
        $vehiculo->traccion = $request->input('traccion');
        $vehiculo->color = $request->input('color');
        $vehiculo->numero_motor = $request->input('numero_motor');
        $vehiculo->numero_chasis = $request->input('numero_chasis');
        $vehiculo->kilometraje = $request->input('kilometraje');
        $vehiculo->save();

        return response()->json($vehiculo);
    }

    public function destroy(Vehiculos $vehiculo)
    {
        $patente = $vehiculo->patente; 
        $vehiculo->delete();
        return response()->json(['estado' => 'eliminado', 'patente' => $patente], 200);
    }
}
