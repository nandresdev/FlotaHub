<?php

namespace App\Http\Controllers;

use App\Models\DocumentosServicios;
use Illuminate\Http\Request;

class DocumentosServiciosController extends Controller
{
    public function listadoDocumentosConductores($servicio)
    {
        $doucmentosServicios = DocumentosServicios::where('id_servicios', $servicio)->where('tipo', 'Conductor')->get();
        return view('web.documentos.listadoDocumentosConductores', compact('doucmentosServicios'));
    }

    public function listadoDocumentosVehiculos($servicio)
    {
        $doucmentosServicios = DocumentosServicios::where('id_servicios', $servicio)->where('tipo', 'Vehiculo')->get();
        return view('web.documentos.listadoDocumentosVehiculos', compact('doucmentosServicios'));
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
