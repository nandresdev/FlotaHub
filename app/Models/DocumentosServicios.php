<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosServicios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_servicios',
        'nombre',
        'tipo',
    ];

    public function servicios()
    {
        return $this->belongsTo(Servicios::class,"id_servicios");
    }


}
