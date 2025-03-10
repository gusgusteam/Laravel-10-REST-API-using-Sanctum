<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidads';

    protected $fillable = ['nombre','nombre_corto','estado'];

    protected $casts = ['estado' => 'boolean'];
}
