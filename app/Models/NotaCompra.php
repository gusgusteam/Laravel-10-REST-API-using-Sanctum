<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class NotaCompra extends Model
{
    use HasFactory;
    protected $table = 'nota_compra';

    protected $fillable = [
        'codigo', 
        'user_id', 
        'gestion_id', 
        'proveedor_id',
        'codigo_factura',
        'codigo_alterno',
        'motivo',
        'fecha', 
        'monto_total', 
        'lugar', 
        'recibido',
        'compra_credito', 
        'estado',
        'firma',
        'nota_alterna'
    ];

    protected $casts = [
        'compra_credito' => 'boolean',
        'estado' => 'boolean',
        'firma' => 'boolean',
        'nota_alterna' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($notaCompra) {
            $notaCompra->codigo = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });

        static::updating(function ($notaCompra) {
            if ($notaCompra->getOriginal('nota_alterna') === true) {
                throw ValidationException::withMessages([
                    'nota_alterna' => ['No se puede actualizar una nota de compra cuando esta anulada.']
                ])->status(400);
            }
        });

        static::updating(function ($notaCompra) {
            if ($notaCompra->isDirty('firma') && !$notaCompra->estado) {
                throw ValidationException::withMessages([
                    'firma' => ['No se puede firmar una nota de compra con el estado pendiente.']
                ])->status(400);
            }
        });

    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'nota_compra_id');
    }

    public function PerteneceProductoEnvase($productoEnvaseId)
    {
        return $this->detallesCompra()
        ->where('producto_envase_id', $productoEnvaseId)
        ->exists();
    }

}
