<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutas extends Model
{
    use HasFactory;

    protected $table = 'rutas_servicios';

    protected $fillable = [
        'id_servicio',
        'origen',
        'destino'
    ];

    public function servicios()
    {
        return $this->belongsTo(Servicios::class,"id_servicio");
    }
}