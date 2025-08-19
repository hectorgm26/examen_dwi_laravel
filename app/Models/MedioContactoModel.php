<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedioContactoModel extends Model
{
    use HasFactory;

    protected $table = 'medio_contacto';

    protected $fillable = [
        'nombre',
        'activo',
    ];
}
