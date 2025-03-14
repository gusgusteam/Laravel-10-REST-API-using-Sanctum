<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envase extends Model
{
    use HasFactory;

    protected $table = 'envases';

    protected $fillable = [
        'cantidad',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
