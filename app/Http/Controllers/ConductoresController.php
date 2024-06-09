<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgregarConductoresRequest;
use App\Http\Requests\EditarConductoresRequest;
use App\Models\Conductores;
use App\Models\Servicios;
use Illuminate\Http\Request;

class ConductoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $conductores = Conductores::all();
        return view("web.conductores.listadoConductores", [
            "conductores" => $conductores
        ]);
    }

    public function create()
    {
        $servicios = Servicios::all();
        return view("web.conductores.agregarConductores", [
            "servicios" => $servicios
        ]);
    }

    public function store(AgregarConductoresRequest $request)
    {
        $conductor = new Conductores();
        $conductor->nombre_completo = $request->input('nombre_completo');
        $conductor->fecha_nacimiento = $request->input('fecha_nacimiento');
        $conductor->telefono = $request->input('telefono');
        $conductor->nacionalidad = $request->input('nacionalidad');
        $conductor->id_servicios = $request->input('id_servicios');
        $conductor->save();

        return response()->json($conductor);
    }

    public function edit($id)
    {
        $servicios = Servicios::all();
        $conductor = Conductores::findOrFail($id);
        return view('web.conductores.editarConductores', [
            "conductor" => $conductor,
            "servicios" => $servicios

        ]);
    }

    public function update(EditarConductoresRequest $request, $id)
    {
        $conductor = Conductores::findOrFail($id);
        $conductor->nombre_completo = $request->input('nombre_completo');
        $conductor->fecha_nacimiento = $request->input('fecha_nacimiento');
        $conductor->telefono = $request->input('telefono');
        $conductor->nacionalidad = $request->input('nacionalidad');
        $conductor->id_servicios = $request->input('id_servicios');
        $conductor->save();

        return response()->json($conductor);
    }

    public function destroy(Conductores $conductor)
    {
        $nombre_completo = $conductor->nombre_completo; 
        $conductor->delete();
        return response()->json(['estado' => 'eliminado', 'nombre_completo' => $nombre_completo], 200);
    }
}
