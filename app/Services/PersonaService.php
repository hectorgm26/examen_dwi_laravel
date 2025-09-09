<?php
 
namespace App\Services;
 
use App\Models\User;
use App\Models\PersonaModel;
 
class PersonaService
{
    public function crearConUsuario(array $data): PersonaModel
    {
        $user = User::create([
            'name' => $data['nombre'],
            'lastname' => $data['apellido'],
            'rut' => $data['rut'],
            'password' => bcrypt(substr($data['apellido'], 0, 1) . $data['nombre']),
            'cargoId' => $data['cargoId'],
            'generoId' => $data['generoId'],
            'fechaNacimiento' => $data['fechaNacimiento'],
        ]);
 
        return PersonaModel::create([
            'user_id' => $user->id,
            'edad' => $data['edad'],
            //'correo' => $data['correo'],
            //'comuna_id' => $data['comuna_id'],
            'oficios_id' => $data['oficios_id'],
            //'medio_contacto_id' => $data['medio_contacto_id'],
            //'telefono' => $data['telefono'],
            //'direccion' => $data['direccion'],
            'nacionalidad_id' => $data['nacionalidad_id'],
        ]);
    }
}