<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    use HasFactory;
    protected $table = 'cultivos';
    
    protected $fillable = ['nombre', 'estado'];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
