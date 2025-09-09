<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadoresModel extends Model
{
    protected $table = 'jugadores';

    protected $fillable = [
        'personaId',
        'piernaDominanteId',
        'posicionesId',
        'camisetasId',
        'activo',
    ];

    // Relación M:N con posiciones
    public function posiciones()
    {
        return $this->belongsToMany(
            PosicionModel::class,
            'jugadorPosicion',
            'jugadorId',
            'posicionId',
            'piernaDominanteId'
        );
    }

    /**
     * Relación con PiernaDominante: Un jugador tiene una pierna dominante.
     */
    public function piernaDominante()
    {
        return $this->belongsTo(PiernaDominanteModel::class, 'pierna_dominante_id');
    }

    public function posicion()
    {
        return $this->belongsTo(PosicionModel::class, 'posiciones_id');
    }

    public function camisetas()
    {
        return $this->belongsTo(CamisetasModel::class, 'camisetas_id');
    }

    public function persona()
    {
        return $this->belongsTo(PersonaModel::class, 'persona_id');
    }
}
