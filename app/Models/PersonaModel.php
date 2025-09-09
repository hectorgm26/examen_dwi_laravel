<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class PersonaModel extends Model
{
    use HasFactory;
 
    protected $table = 'persona';
 
    protected $fillable = [
        'userId',
        'edad',
        //'correo',
        'nacionalidadId',
        //'telefono',
        //'direccion',
        //'comuna_id',
        'oficiosId',
        //'medio_contacto_id'
    ];
   
    public function user()
{
    return $this->belongsTo(User::class, 'userId');
}

public function jugadores()
{
    return $this->hasOne(JugadoresModel::class, 'personaId');
}

public function genero()
{
    return $this->belongsTo(GeneroModel::class, 'generoId');
}

/*public function comuna()
{
    return $this->belongsTo(ComunasModel::class, 'comuna_id'); // <-- corregido aquí
}*/

public function oficio()
{
    return $this->belongsTo(OficiosModel::class, 'oficiosId');
}

/*public function medioContacto()
{
    return $this->belongsTo(MedioContactoModel::class, 'medio_contacto_id');
}*/

public function nacionalidad()
{
    return $this->belongsTo(NacionalidadModel::class, 'nacionalidadId');
}


}
 
 