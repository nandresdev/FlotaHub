<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Http\Requests\EditarServicioRequest;
use App\Http\Requests\AgregarServicioRequest;

class ServicioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $servicios = Servicios::all();
        return view("web.servicios.listadoServicio", [
            "servicios" => $servicios
        ]);
    }

    public function store(AgregarServicioRequest $request)
    {
        $servicios = new Servicios();
        $servicios->nombre = $request->input('nombre');
        $servicios->save();
        return response()->json($servicios);
    }


    public function update(EditarServicioRequest $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        $servicio->nombre = $request->input('nombre');
        $servicio->save();

        return response()->json($servicio);
    }



    public function destroy(Servicios $servicio)
    {
        $nombre = $servicio->nombre;
        $servicio->delete();
        return response()->json(['estado' => 'eliminado', 'nombre' => $nombre], 200);
    }
}
