<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class NotaVenta extends Model
{
    use HasFactory;
    protected $table = 'nota_ventas';

    protected $fillable = [
        'codigo', 
        'cliente_id', 
        'user_id', 
        'gestion_id', 
        'cultivo_id',
        'codigo_factura',
        'codigo_alterno',
        'motivo',
        'fecha', 
        'monto_total', 
        'lugar', 
        'recibido',
        'venta_credito', 
        'estado',
        'firma',
        'nota_alterna'
    ];

    protected $casts = [
        'venta_credito' => 'boolean',
        'estado' => 'boolean',
        'firma' => 'boolean',
        'nota_alterna' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($notaVenta) {
            $notaVenta->codigo = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });

        static::updating(function ($notaVenta) {
            if ($notaVenta->getOriginal('nota_alterna') === true) {
                throw ValidationException::withMessages([
                    'nota_alterna' => ['No se puede actualizar una nota de venta cuando esta anulada.']
                ])->status(400);
            }
        });

        static::updating(function ($notaVenta) {
            if ($notaVenta->isDirty('firma') && !$notaVenta->estado) {
                throw ValidationException::withMessages([
                    'firma' => ['No se puede firmar una nota de venta con el estado pendiente.']
                ])->status(400);
            }
        });

        static::deleting(function ($notaVenta) {
        
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'nota_venta_id');
    }

    public function PerteneceProductoEnvase($productoEnvaseId)
    {
        return $this->detallesVenta()
        ->where('producto_envase_id', $productoEnvaseId)
        ->exists();
    }

}
