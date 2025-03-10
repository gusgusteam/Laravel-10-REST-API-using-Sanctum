<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoEnvase extends Model
{
    use HasFactory;
    protected $table = 'producto_envase';
    //public $incrementing = false;
    //protected $primaryKey = null; 
    protected $fillable = ['producto_id', 'unidad_id', 'cantidad', 'estado'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }


    protected $casts = [
        'estado' => 'boolean',
    ];
}

