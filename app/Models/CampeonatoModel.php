<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampeonatoModel extends Model
{
    use HasFactory;

    protected $table = 'campeonato';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion',
        'comunaId',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean',
        'equipos' => 'array',
    ];

    /**
     * Relación con Comuna: Un jugador vive en una comuna.
     */
    public function comuna()
    {
        return $this->belongsTo(ComunasModel::class, 'comunaId');
    }
}
