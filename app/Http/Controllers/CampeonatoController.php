<?php

namespace App\Http\Controllers;

use App\Models\CampeonatoModel; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CampeonatoController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        
        $user = Auth::user();

        $lista = CampeonatoModel::all();

        // $comunasSantiago = [
        //     'Cerrillos',
        //     'Cerro Navia',
        //     'Conchalí',
        //     'El Bosque',
        //     'Estación Central',
        //     'Huechuraba',
        //     'Independencia',
        //     'La Cisterna',
        //     'La Florida',
        //     'La Granja',
        //     'La Pintana',
        //     'La Reina',
        //     'Las Condes',
        //     'Lo Barnechea',
        //     'Lo Espejo',
        //     'Lo Prado',
        //     'Macul',
        //     'Maipú',
        //     'Ñuñoa',
        //     'Padre Hurtado',
        //     'Pedro Aguirre Cerda',
        //     'Peñalolén',
        //     'Pirque',
        //     'Providencia',
        //     'Pudahuel',
        //     'Puente Alto',
        //     'Quilicura',
        //     'Quinta Normal',
        //     'Recoleta',
        //     'Renca',
        //     'San Bernardo',
        //     'San Joaquín',
        //     'San José de Maipo',
        //     'San Miguel',
        //     'San Ramón',
        //     'Santiago'  
        // ];

        $datos = [
            'textos' => [
                'titulo' => 'Campeonatos | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',

            ],
            'mantenedor' => [
                'titulo' => 'Campeonatos',
                'instruccion' => 'Gestiona todos los futuros campeonatos aqui.',
                'routes' => [
                    'new' => 'backoffice.campeonato.create',
                    'up' => 'backoffice.campeonato.up',
                    'down' => 'backoffice.campeonato.down',
                    'delete' => 'backoffice.campeonato.destroy',
                    'index' => 'backoffice.campeonato.index',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre del Campeonato',
                        'name' => 'nombre',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Introduce el nombre',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Descripción del campeonato',
                        'name' => 'descripcion',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 40,
                            'max' => 250,
                            'placeholder' => 'Introduce la descripcion del campeonato',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Fecha de Inicio',
                        'name' => 'fecha_inicio',
                         'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => ['form-control'],
                            'min' => null,
                            'max' => null,
                            'placeholder' => 'Selecciona la fecha de inicio',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Fecha de Fin',
                        'name' => 'fecha_fin',
                         'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => ['form-control'],
                            'min' => null,
                            'max' => null,
                            'placeholder' => 'Selecciona la fecha de fin',
                        ],
                        'required' => true,
                    ],
                     [
                        'label' => 'Ubicación',
                        'name' => 'ubicacion',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 3,
                            'max' => 20,
                            'placeholder' => 'Introduce la ubicación',
                        ],
                        'required' => true,
                    ],
                    // [
                    //     'label' => 'Comuna',
                    //     'name' => 'comuna',
                    //     'control' => [
                    //         'element' => 'select', 
                    //         'type' => 'select', 
                    //         'classList' => ['form-control'],
                    //         'options' => $comunasSantiago, 
                    //     ],
                    //     'required' => true,
                    // ]
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://wwwipsss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
        ];

        $campeonatos = CampeonatoModel::all();

        return view('backoffice/campeonato/index', [
            'datos' => $datos,
            'user' => $user,
            'campeonatos' => $campeonatos,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Validar los campos del campeonato
        $request->validate([
            'nombre' => ['required', 'string', 'max:15', 'min:3'],
            'descripcion' => ['required', 'string', 'max:250', 'min:40'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'ubicacion' => ['required', 'string', 'max:50', 'min:3'],
            // 'comuna' => ['required'],
        ],  $this->messages); 

        CampeonatoModel::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
            // 'comuna' => $request->comuna,
            'activo' => $request->activo ?? true, 
        ]); 

        return redirect()->back()->with('success', ':) Campeonato creado exitosamente.');
    }

    public function show(CampeonatoModel $campeonatoModel)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Retorna la vista show con el campeonato
        return view('backoffice.campeonato.show', compact('campeonatoModel')); 
    }

    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Campeonato eliminado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Campeonato apagado exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }

    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Campeonato encendido exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
}