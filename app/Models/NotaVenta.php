<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;
    protected $table = 'nota_ventas';

    protected $fillable = ['codigo', 'cliente_id', 'user_id', 'gestion_id', 'cultivo_id','codigo_factura','codigo_alterno','motivo','fecha', 'monto_total', 'lugar', 'recibido','venta_credito', 'estado','firma','nota_alterna'];

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
}
