<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table = 'detalle_compra';
    protected $fillable = [
        'nota_compra_id',
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

        static::updated(function ($detalleCompra) {
            $detalleCompra->actualizarMontoTotal();
        });
    
        static::deleting(function ($detalleCompra) {
            if ($detalleCompra->notaCompra->firma || $detalleCompra->notaCompra->nota_alterna) {
                return false; 
            }
            $detalleCompra->actualizarMontoTotalDespuesDeEliminar();
        });

        static::created(function ($detalleCompra) {
            $detalleCompra->actualizarEstadoNota(); // actualizar estado de nota venta
            $detalleCompra->actualizarMontoTotal(); // actualizar el monto total
        });

        static::creating(function ($detalleCompra) {
            if ($detalleCompra->notaCompra->firma || $detalleCompra->notaCompra->nota_alterna) {
                return false; 
            }
            $detalleCompra->subtotal = $detalleCompra->precio_asignado * $detalleCompra->cantidad;
        });

        static::updating(function ($detalleCompra) {
            if ($detalleCompra->notaCompra->firma  || $detalleCompra->notaCompra->nota_alterna ) { // verificar si esta firmado 
                return false; 
            }
            if ($detalleCompra->cantidad <= 0) { // si es 0 se elimina 
                $detalleCompra->delete();
                return false; 
            }
            $detalleCompra->subtotal = $detalleCompra->precio_asignado * $detalleCompra->cantidad;
        });
    }

    public function notaCompra()
    {
        return $this->belongsTo(NotaCompra::class, 'nota_compra_id');
    }

    public function productoEnvase()
    {
        return $this->belongsTo(ProductoEnvase::class, 'producto_envase_id');
    }

    public function actualizarMontoTotal()
    {
        $notaCompra = $this->notaCompra;
        if ($notaCompra) {
            $nuevoMontoTotal = $notaCompra->detallesCompra()->sum('subtotal');
            $notaCompra->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarMontoTotalDespuesDeEliminar()
    {
        $notaCompra = $this->notaCompra;
        if ($notaCompra) {
            $nuevoMontoTotal = $notaCompra->detallesCompra()->where('id', '!=', $this->id)->sum('subtotal');
            $notaCompra->update(['monto_total' => $nuevoMontoTotal]);
        }
    }

    public function actualizarEstadoNota()
    {
        $notaCompra = $this->notaCompra;
        if ($notaCompra && !$notaCompra->estado) {
            $notaCompra->estado = 1; // Cambia el estado
            $notaCompra->update(); // Guarda los cambios
            $notaCompra->refresh();
        }
    }
    

    protected $casts = [
        'estado' => 'boolean'
    ];
}
