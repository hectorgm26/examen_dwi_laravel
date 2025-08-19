<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasSemanaModel extends Model
{
    use HasFactory;

    protected $table = 'dias_semana';

    protected $fillable = [
        'nombre',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
