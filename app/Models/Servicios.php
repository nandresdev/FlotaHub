<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre',
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
}