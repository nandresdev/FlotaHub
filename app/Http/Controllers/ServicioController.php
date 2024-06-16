<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Http\Requests\EditarServicioRequest;
use App\Http\Requests\AgregarServicioRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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
        $servicios->fecha_inicio = $request->input('fecha_inicio');
        $servicios->fecha_fin = $request->input('fecha_fin');
        $servicios->save();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $uploadResult = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'servicios',
                'public_id' => time()
            ]);
            $servicios->foto = $uploadResult->getSecurePath();
        }

        $servicios->save();
        return response()->json($servicios);
    }
    public function update(EditarServicioRequest $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        $servicio->nombre = $request->input('nombre');
        $servicio->fecha_inicio = $request->input('fecha_inicio');
        $servicio->fecha_fin = $request->input('fecha_fin');

        if ($request->hasFile('foto')) {
            if ($servicio->foto) {
                $publicId = basename($servicio->foto, '.' . pathinfo($servicio->foto, PATHINFO_EXTENSION));
                Cloudinary::destroy("servicios/{$publicId}");
            }
            $file = $request->file('foto');
            $uploadResult = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'servicios',
                'public_id' => time()
            ]);
            $servicio->foto = $uploadResult->getSecurePath();
        }

        $servicio->save();

        return response()->json($servicio);
    }


    public function destroy(Servicios $servicio)
    {
        $nombre = $servicio->nombre;
        $servicio->delete();
        return response()->json(['estado' => 'eliminado', 'nombre' => $nombre], 200);
    }

    public function obtenerConductores($id)
    {
        $servicios = Servicios::findOrFail($id);
        $conductor = $servicios->conductor;
        return view('web.servicios.listadoServicioConductores', compact('conductor'));
    }

    public function obtenerVehiculos($id)
    {
        $servicios = Servicios::findOrFail($id);
        $vehiculo = $servicios->vehiculo;
        return view('web.servicios.listadoServicioVehiculos', compact('vehiculo'));
    }
}