<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediosPagosModel extends Model
{
    use HasFactory;

    protected $table = 'medios_pagos';

    protected $fillable = [
        'nombre',
        'activo',
    ];
}
