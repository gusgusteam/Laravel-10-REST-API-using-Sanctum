<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class NotaDevolucion extends Model
{
    use HasFactory;

    protected $table = 'nota_devolucion';

    protected $fillable = [
        'codigo', 
        'cliente_id',
        'proveedor_id', 
        'user_id', 
        'gestion_id', 
        'codigo_factura',
        'nota_alterna',
        'codigo_alterno',
        'motivo',
        'fecha', 
        'monto_total', 
        'lugar', 
        'recibido',
        'estado',
        'firma'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'firma' => 'boolean',
        'nota_alterna' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($notaDevolucion) {
            $notaDevolucion->codigo = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });

        static::updating(function ($notaDevolucion) {
            if ($notaDevolucion->isDirty('firma') && !$notaDevolucion->estado) {
                throw ValidationException::withMessages([
                    'firma' => ['No se puede firmar una devolucion con el estado pendiente.']
                ])->status(400);
            }
        });

        static::deleting(function ($notaDevolucion) {
        
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function detallesDevolucion()
    {
        return $this->hasMany(DetalleDevolucion::class, 'nota_devolucion_id');
    }

    public function PerteneceProductoEnvase($productoEnvaseId)
    {
        return $this->detallesDevolucion()
        ->where('producto_envase_id', $productoEnvaseId)
        ->exists();
    }
}
