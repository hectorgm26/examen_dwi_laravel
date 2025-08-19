<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraFinModel extends Model
{
    use HasFactory;

    protected $table = 'hora_fin';

    protected $fillable = [
        'nombre',
        'activo',
    ];
}
