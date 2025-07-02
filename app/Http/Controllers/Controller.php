<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Mensajes personalizados para esta validación
    public $messages = [
        'username.unique' => 'Este nombre de usuario (email) ya está en uso. Por favor, elige otro.',
        // Puedes añadir más mensajes específicos si lo necesitas, por ejemplo:
        // 'name.required' => 'El campo Nombre es obligatorio.',
        // 'password.confirmed' => 'Las contraseñas no coinciden.',
    ];
}
