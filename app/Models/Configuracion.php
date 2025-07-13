<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuracion';

    protected $fillable = [
        'nombre_empresa',
        'direccion',
        'telefono',
        'email',
        'nit',
        'razon_social',
        'frase',
        'logo',
        'id_gestion',
    ];

}
