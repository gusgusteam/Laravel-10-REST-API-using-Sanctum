<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = ['codigo', 'nombre', 'paterno', 'materno', 'ci', 'direccion', 'telefono', 'estado'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cliente) {
            do {
                $codigo = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (self::where('codigo', $codigo)->exists());

            $cliente->codigo = $codigo;
        });
    }

    protected $casts = [
        'estado' => 'boolean',
    ];
}
