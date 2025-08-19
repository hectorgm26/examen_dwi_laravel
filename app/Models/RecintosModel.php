<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecintosModel extends Model
{
    use HasFactory;

    protected $table = 'recintos';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'activo',
    ];
}