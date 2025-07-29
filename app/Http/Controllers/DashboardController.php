<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){

        $user = [];
        if (Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            $user = Auth::user();
        }

        $datos = [
            'textos' => [
                'titulo' => 'Inicio | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/dashboard/index', $datos);
    }

}
