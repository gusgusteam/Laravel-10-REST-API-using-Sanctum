<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedor';

    protected $fillable = ['image','codigo', 'razon_social', 'direccion', 'correo', 'telefono', 'estado'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($proveedor) {
            do {
                $codigo = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (self::where('codigo', $codigo)->exists());

            $proveedor->codigo = $codigo;
        });
    }

    protected $casts = [
        'estado' => 'boolean',
    ];
}
