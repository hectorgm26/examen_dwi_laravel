<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ importar el trait

class HorainicioModel extends Model
{
    use HasFactory; // ✅ ahora sí lo encuentra

    protected $table = 'hora_inicio'; // 👈 aquí probablemente debería ser 'horainicio' si es la tabla correcta

    protected $fillable = [
        'nombre',
        'activo',
    ];
}

