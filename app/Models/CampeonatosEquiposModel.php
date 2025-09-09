<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampeonatosEquiposModel extends Model
{
    use HasFactory;

    protected $table = 'campeonatos_equipos';

    protected $fillable = [
        'campeonatoId',
        'equipoId',
        'activo',
    ];
}

