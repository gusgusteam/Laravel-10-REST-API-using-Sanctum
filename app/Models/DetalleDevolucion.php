<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    use HasFactory;
    protected $table = 'detalle_devolucion';
    protected $fillable = [
        'nota_devolucion_id',
        'producto_envase_id',
        'precio_asignado',
        'cantidad',
        'subtotal',
        'observacion',
        'estado'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($detalleDevolucion) {
            $detalleDevolucion->actualizarMontoTotal();
        });
    
        static::deleting(function ($detalleDevolucion) {
            if ($detalleDevolucion->notaDevolucion->firma || $detalleDevolucion->notaDevolucion->nota_alterna) {
                return false; 
            }
            $detalleDevolucion->actualizarMontoTotalDespuesDeEliminar();
        });

        static::created(function ($detalleDevolucion) {
            $detalleDevolucion->actualizarEstadoNota(); // actualizar estado de nota venta
            $detalleDevolucion->actualizarMontoTotal(); // actualizar el monto total
        });

        static::creating(function ($detalleDevolucion) {
            if ($detalleDevolucion->notaDevolucion->firma || $detalleDevolucion->notaDevolucion->nota_alterna) {
                return false; 
            }
            $detalleDevolucion->subtotal = $detalleDevolucion->precio_asignado * $detalleDevolucion->cantidad;
        });

        static::updating(function ($detalleDevolucion) {
            if ($detalleDevolucion->notaDevolucion->firma || $detalleDevolucion->notaDevolucion->nota_alterna ) { // verificar si esta firmado 
                return false; 
            }
            if ($detalleDevolucion->cantidad <= 0) { // si es 0 se elimina 
                $detalleDevolucion->delete();
                return false; 
            }
            $detalleDevolucion->subtotal = $detalleDevolucion->precio_asignado * $detalleDevolucion->cantidad;
        });
    }

    public function notaDevolucion()
    {
        return $this->belongsTo(NotaDevolucion::class, 'nota_devolucion_id');
    }

    public function productoEnvase()
    {
        return $this->belongsTo(ProductoEnvase::class, 'producto_envase_id');
    }

    public function actualizarMontoTotal()
    {
        $notaDevolucion = $this->notaDevolucion;
        if ($notaDevolucion) {
            $nuevoMontoTotal = $notaDevolucion->detallesDevolucion()->sum('subtotal');
            $notaDevolucion->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarMontoTotalDespuesDeEliminar()
    {
        $notaDevolucion = $this->notaDevolucion;
        if ($notaDevolucion) {
            $nuevoMontoTotal = $notaDevolucion->detallesDevolucion()->where('id', '!=', $this->id)->sum('subtotal');
            $notaDevolucion->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarEstadoNota()
    {
        $notaDevolucion = $this->notaDevolucion;
        if ($notaDevolucion && !$notaDevolucion->estado) {
            $notaDevolucion->estado = 1; // Cambia el estado
            $notaDevolucion->update(); // Guarda los cambios
            $notaDevolucion->refresh();
        }
    }
    

    protected $casts = [
        'estado' => 'boolean'
    ];
}
