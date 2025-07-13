<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'dosis',  
        'estado', 
        'categoria_id', 
        'tipo_producto_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class);
    }
    protected $casts = [
        'estado' => 'boolean',
    ];
}
