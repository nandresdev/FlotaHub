<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'foto'
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_fin'
    ];

    public function vehiculo()
    {
        return $this->hasMany(Vehiculos::class, "id_servicios");
    }

    public function conductor()
    {
        return $this->hasMany(Conductores::class, "id_servicios");
    }

    public function documentosServicio()
    {
        return $this->hasMany(DocumentosServicios::class, "id_servicios");
    }

    public function ruta()
    {
        return $this->hasMany(Rutas::class, "id_servicio");
    }
}
