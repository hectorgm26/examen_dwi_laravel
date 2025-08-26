<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsideModel extends Model
{
    use HasFactory;

    protected $table = 'aside';

    protected $fillable = [
        'nombre',
        'ruta',
        'icono',
        'activo',
    ];
}
