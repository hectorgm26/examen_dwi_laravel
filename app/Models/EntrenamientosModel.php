<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntrenamientosModel extends Model
{
    use HasFactory;

    protected $table = 'entrenamientos';

    protected $fillable = [
        'nombre',
        'entrenador',
        'hora_inicio',
        'hora_fin',
        'jugador',
        'activo',
    ];
}
