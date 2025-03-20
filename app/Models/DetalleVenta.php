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

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($detalleVenta) {
            $detalleVenta->actualizarMontoTotal();
        });
    
        static::deleting(function ($detalleVenta) {
            if ($detalleVenta->notaVenta->firma || $detalleVenta->notaVenta->nota_alterna) {
                return false; 
            }
            $detalleVenta->actualizarMontoTotalDespuesDeEliminar();
        });

        static::created(function ($detalleVenta) {
            $detalleVenta->actualizarEstadoNota(); // actualizar estado de nota venta
            $detalleVenta->actualizarMontoTotal(); // actualizar el monto total
        });

        static::creating(function ($detalleVenta) {
            if ($detalleVenta->notaVenta->firma || $detalleVenta->notaVenta->nota_alterna) {
                return false; 
            }
            $detalleVenta->subtotal = $detalleVenta->precio_asignado * $detalleVenta->cantidad;
        });

        static::updating(function ($detalleVenta) {
            if ($detalleVenta->notaVenta->firma  || $detalleVenta->notaVenta->nota_alterna ) { // verificar si esta firmado 
                return false; 
            }
            if ($detalleVenta->cantidad <= 0) { // si es 0 se elimina 
                $detalleVenta->delete();
                return false; 
            }
            $detalleVenta->subtotal = $detalleVenta->precio_asignado * $detalleVenta->cantidad;
        });
    }

    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class, 'nota_venta_id');
    }

    public function productoEnvase()
    {
        return $this->belongsTo(ProductoEnvase::class, 'producto_envase_id');
    }

    public function actualizarMontoTotal()
    {
        $notaVenta = $this->notaVenta;
        if ($notaVenta) {
            $nuevoMontoTotal = $notaVenta->detallesVenta()->sum('subtotal');
            $notaVenta->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarMontoTotalDespuesDeEliminar()
    {
        $notaVenta = $this->notaVenta;
        if ($notaVenta) {
            $nuevoMontoTotal = $notaVenta->detallesVenta()->where('id', '!=', $this->id)->sum('subtotal');
            $notaVenta->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarEstadoNota()
    {
        $notaVenta = $this->notaVenta;
        if ($notaVenta && !$notaVenta->estado) {
            $notaVenta->estado = 1; // Cambia el estado
            $notaVenta->update(); // Guarda los cambios
            $notaVenta->refresh();
        }
    }
    

    protected $casts = [
        'estado' => 'boolean'
    ];
}
