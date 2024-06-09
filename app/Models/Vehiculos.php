<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_vehiculo',
        'patente',
        'marca',
        'marca',
        'modelo',
        'combustible',
        'ano',
        'traccion',
        'color',
        'numero_motor',
        'numero_chasis',
        'kilometraje',
        'id_servicios',
    ];

    public function servicios()
    {
        return $this->belongsTo(Servicios::class,"id_servicios");
    }
}
