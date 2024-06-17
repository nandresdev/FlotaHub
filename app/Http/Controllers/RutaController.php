<?php

namespace App\Http\Controllers;

use App\Models\Rutas;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Http\Requests\AgregarRutaRequest;
use App\Http\Requests\EditarRutaRequest;

class RutaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rutas = Rutas::all();
        $servicios = Servicios::all();
        return view("web.rutas.listadoRuta", [
            "rutas" => $rutas,
            "servicios" => $servicios
        ]);
    }

    public function store(AgregarRutaRequest $request)
    {
        $ruta = new Rutas();
        $ruta->id_servicio = $request->input('id_servicio');
        $ruta->origen = $request->input('origen');
        $ruta->destino = $request->input('destino');
        $ruta->save();

        return response()->json($ruta);
    }

    public function edit($id)
    {
        $ruta = Rutas::findOrFail($id);
        $servicios = Servicios::all();
        return view('web.rutas.editarRuta', [
            "ruta" => $ruta,
            "servicios" => $servicios
        ]);
    }

    public function update(EditarRutaRequest $request, $id)
    {
        $ruta = Rutas::findOrFail($id);
        $ruta->id_servicio = $request->input('id_servicio');
        $ruta->origen = $request->input('origen');
        $ruta->destino = $request->input('destino');
        $ruta->save();

        return response()->json($ruta);
    }

    public function destroy(Rutas $ruta)
    {
        $ruta->delete();
        return response()->json(['estado' => 'eliminado'], 200);
    }
}