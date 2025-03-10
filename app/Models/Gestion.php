<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    protected $table = 'gestiones';
    protected $fillable = [
        'anio',
        'nombre_campania',
        'gestion_actual',
        'estado',
    ];

    protected $casts = [
        'gestion_actual' => 'boolean',
        'estado' => 'boolean',
    ];
}

