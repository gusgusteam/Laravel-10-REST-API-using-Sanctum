<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_ventas';
    protected $fillable = [
        'nota_venta_id',
        'producto_envase_id',
        'precio_asignado',
        'cantidad',
        'subtotal',
        'dosis_recomendada',
        'dosis_comercial',
        'observacion',
        'estado'
    ];

    // Relación con NotaVenta
    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class);
    }

    // Relación con ProductoEnvase
    public function productoEnvase()
    {
        return $this->belongsTo(ProductoEnvase::class);
    }
}
