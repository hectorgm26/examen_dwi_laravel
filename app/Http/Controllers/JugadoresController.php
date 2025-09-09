<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JugadoresModel;
use App\Models\GeneroModel;
use App\Models\ComunasModel;
use App\Models\OficiosModel;
use App\Models\MedioContactoModel;
use App\Models\PosicionModel;
use App\Models\PiernaDominanteModel;
use App\Models\CargosModel;
use App\Models\NacionalidadModel;
use App\Models\CamisetasModel;
use Illuminate\Support\Facades\DB;
use App\Services\PersonaService;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

 
class JugadoresController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        
        $lista = JugadoresModel::with([
            'persona.user',
            'persona.genero',
            //'persona.comuna',
            'persona.oficio',
            'persona.nacionalidad',
            //'persona.medioContacto',
            'piernaDominante',
            'posicion', // Relación principal para FK posiciones_id
        ])->get();

        $generos = GeneroModel::all();
        //$comuna = ComunasModel::all();
        $oficios = OficiosModel::all();
        //$medioContacto = MedioContactoModel::all();
        $posiciones = PosicionModel::all();
        $piernaDominante = PiernaDominanteModel::all();
        $nacionalidad = NacionalidadModel::where('activo', 1)->get();
        $camisetas = CamisetasModel::where('activo', 1)->get();


        $opcionesGenero = $generos->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        /*$opcionesComuna = $comuna->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();*/

        $opcionesOficios = $oficios->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        /*$opcionesMedioContacto = $medioContacto->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();*/

        $opcionesPosiciones = $posiciones->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        $opcionesPiernaDominante = $piernaDominante->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        $opcionesNacionalidad = $nacionalidad->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        $opcionesCamisetas = $camisetas->map(fn($g) => [
            'value' => $g->id,
            'label' => $g->nombre
        ])->toArray();

        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Jugadores',
                'instruccion' => 'Listado de los jugadores.',
                'routes' => [
                    'new'    => 'backoffice.jugadores.new',
                    'update' => 'backoffice.jugadores.update',
                    'delete' => 'backoffice.jugadores.destroy',
                    'up'     => 'backoffice.jugadores.up',
                    'down'   => 'backoffice.jugadores.down',
                ],
                'fields' => [
                    [
                        'label' => 'RUT',
                        'name' => 'rut',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'min' => 3,
                            'max' => null,
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => '12.345.678-9'
                        ],
                    ],
                    [
                        'label' => 'Nombre',
                        'name' => 'nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Nombre del jugador'
                        ],
                    ],
                    [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 2,
                            'max' => 50,
                            'placeholder' => 'Apellido del jugador'
                        ],
                    ],
                    
[
    'label' => 'Fecha de Nacimiento',
    'name' => 'fechaNacimiento',
    'required' => true,
    'control' => [
        'element' => 'input',
        'type' => 'date',
        'classList' => ['form-control', 'mb-4'],
        'min' => 3,
        'max' => 50,
        'placeholder' => 'Ingrese fecha de nacimiento'
    ],
    'access' => [
        'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
        'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
    ]
],

                    //Edad
                    
                    /*
[
    'label' => 'Edad',
    'name' => 'edad',
    'required' => true,
    'control' => [
        'element' => 'input',
        'type' => 'number',
        'min' => 0,
        'max' => null,
        'classList' => ['form-control', 'mb-4'],
        'placeholder' => null,
    ],
],
*/
                    //Cargo
                    //Genero
                    [
                        'label' => 'Género',
                        'name' => 'genero_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesGenero,
                            'disabled' => $generos->isEmpty(),
                            'placeholder' => $generos->isEmpty() ? 'Sin registros' : 'Seleccione género'
                        ],
                    ],
                    //Comuna
                    /*[
                        'label' => 'Comuna',
                        'name' => 'comuna_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesComuna,
                            'disabled' => $comuna->isEmpty(),
                            'placeholder' => $comuna->isEmpty() ? 'Sin registros' : 'Seleccione comuna'
                        ],
                    ],
                    */
                    //Oficios
                    [
                        'label' => 'Oficios',
                        'name' => 'oficios_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesOficios,
                            'disabled' => $oficios->isEmpty(),
                            'placeholder' => $oficios->isEmpty() ? 'Sin registros' : 'Seleccione oficio'
                        ],
                    ],

                    //Medio Contacto
                    /*[
                        'label' => 'Medios de contacto',
                        'name' => 'medio_contacto_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesMedioContacto,
                            'disabled' => $medioContacto->isEmpty(), 
                            'placeholder' => $medioContacto->isEmpty() ? 'Sin registros' : 'Seleccione medio de contacto'
                        ],
                    ],
                    */

                    //Telefono 
                    /*                    
                    [
                        'label' => 'Telefono',
                        'name' => 'telefono',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'number',
                            'min' => 0,
                            'max' => null,
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => '+12345678',
                        ],
                    ],
                    */
                    //Correo
                    /*
                    [
                        'label' => 'Correo',
                        'name' => 'correo',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'email',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'example@example.com'
                        ],
                    ],
                    */
                    //Direccion
                    /*
                    [
                        'label' => 'Direccion',
                        'name' => 'direccion',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 3,
                            'max' => 100,
                            'placeholder' => null,
                        ],
                    ],
                    */
                    //Nacionalidad
                    [
                        'label' => 'Nacionalidad',
                        'name' => 'nacionalidad_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesNacionalidad,
                            'disabled' => $nacionalidad->isEmpty(), 
                            'placeholder' => $nacionalidad->isEmpty() ? 'Sin registros' : 'Seleccione una nacionalidad'
                        ],
                    ],
                    //Posicion
                    [
                        'label' => 'Posicion',
                        'name' => 'posiciones_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesPosiciones,
                            'disabled' => $posiciones->isEmpty(), 
                            'placeholder' => $posiciones->isEmpty() ? 'Sin registros' : 'Seleccione posicion'
                        ],
                    ],
                    //Dorsal
                    [
                        'label' => 'Dorsal',
                        'name' => 'camisetas_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesCamisetas,
                            'disabled' => $camisetas->isEmpty(), 
                            'placeholder' => $camisetas->isEmpty() ? 'Sin registros' : 'Seleccione dorsal'
                        ],
                    ],
                    //Pierna dominante
                    [
                        'label' => 'Pierna dominante',
                        'name' => 'pierna_dominante_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $opcionesPiernaDominante,
                            'disabled' => $piernaDominante->isEmpty(), 
                            'placeholder' => $piernaDominante->isEmpty() ? 'Sin registros' : 'Seleccione pierna'
                        ],
                    ],
                ],
                'access' => [
                    'editableIn' => [
                        'new' => true,
                        'edit' => true,
                        'show' => false,
                        'up' => false,
                        'down' => false,
                        'delete' => false
                    ],
                    'readIn' => [
                        'new' => true,
                        'edit' => true,
                        'show' => true,
                        'up' => true,
                        'down' => true,
                        'delete' => true
                    ]
                ],
                
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];
 
        return view('backoffice/jugadores/index', compact('datos', 'user', 'lista'));
    }
 
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('/')->withErrors('Debe iniciar sesión.');
    }

    $validated = $request->validate([
        'nombre'              => ['required', 'string', 'min:3', 'max:50'],
        'apellido'            => ['required', 'string', 'min:2', 'max:50'],
        'rut'                 => ['required', 'string', 'unique:users,rut'],
        // 'edad'              => ['required', 'integer', 'min:0'], // <- comentado o eliminado
        'genero_id'            => ['required', Rule::exists('genero', 'id')],
        //'telefono'            => ['required', 'string', 'min:3'],
        //'correo'              => ['required', 'email', 'unique:persona,correo'],
        //'direccion'           => ['required', 'string', 'min:3', 'max:100'],
        // cargo eliminado
        //'comuna_id'           => ['required', Rule::exists('comunas', 'id')],
        'oficios_id'          => ['required', Rule::exists('oficios', 'id')],
        //'medio_contacto_id'   => ['required', Rule::exists('medio_contacto', 'id')],
        'nacionalidad_id'     => ['required', Rule::exists('nacionalidad', 'id')],
        'posiciones_id'       => ['required', Rule::exists('posiciones', 'id')],
        'pierna_dominante_id' => ['required', Rule::exists('pierna_dominante', 'id')],
        'fechaNacimiento'     => ['required', 'date'],
        'camisetas_id'       => ['required', Rule::exists('camisetas', 'id')],
    ], $this->messages);
    
    $idCargoJugador = 2; 
    
    // Cálculo de edad
    $fechaNacimiento = $validated['fechaNacimiento'];
    $edad = Carbon::parse($fechaNacimiento)->age;
    
    $personaService = app(PersonaService::class);
    $persona = $personaService->crearConUsuario([
        'nombre'             => $validated['nombre'],
        'apellido'           => $validated['apellido'],
        'rut'                => $validated['rut'],
        'edad'               => $edad, // <-- edad calculada
        //'telefono'           => $validated['telefono'],
        //'correo'             => $validated['correo'],
        //'direccion'          => $validated['direccion'],
        'nacionalidad_id'    => $validated['nacionalidad_id'],
        //'comuna_id'          => $validated['comuna_id'],
        'oficios_id'         => $validated['oficios_id'],
        //'medio_contacto_id'  => $validated['medio_contacto_id'],
        'cargoId'            => $idCargoJugador,
        'generoId'           => $validated['genero_id'],
        'fechaNacimiento'    => $fechaNacimiento,
        'camisetas_id'      => $validated['camisetas_id']
    ]);
        
    
        // Crear jugador vinculado a la persona
        JugadoresModel::create([
            'persona_id'          => $persona->id,
            'pierna_dominante_id'  => $validated['pierna_dominante_id'],
            'posiciones_id'         => $validated['posiciones_id'],
            'camisetas_id'       => $validated['camisetas_id'],
            'activo'              => true,
        ]);
    
        return redirect()->back()->with('success', 'Jugador creado exitosamente.');
    }
 
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
 
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:50'],
            // 'edad' => ['required', 'integer', 'min:0'],
            'generoId' => ['required'],
            //'telefono' => ['required', 'string', 'min:0'],
            //'correo' => ['required', 'email'],
        ], $this->messages);
 
        $jugador = JugadoresModel::findOrFail($id);
        $jugador->update([
            'nombre' => $request->nombre,
            'edad' => $request->edad,
            'generoId' => $request->genero_id,
            //'telefono' => $request->telefono,
            //'correo' => $request->correo,
            //'nivel' => $request->nivel,
        ]);
 
        return redirect()->back()->with('success', 'Jugador actualizado exitosamente.');
    }
 
    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
    
        $jugador = JugadoresModel::with('persona.user')->find($_id);
    
        if (!$jugador || !$jugador->persona || !$jugador->persona->user) {
            return redirect()->back()->withErrors('Jugador o usuario no encontrado.');
        }
    
        // Cambiar el estado en la tabla users
        if ($jugador->persona->user->activo == 1) {
            $jugador->persona->user->activo = 0;
            $jugador->persona->user->save();
    
            // También cambiar el estado del jugador
            $jugador->activo = 0;
            $jugador->save();
    
            return redirect()->back()->with('success', 'Jugador desactivado exitosamente.');
        }
    
        return redirect()->back()->withErrors('No se realizaron cambios.');
    }
    

    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
    
        $jugador = JugadoresModel::with('persona.user')->find($_id);
    
        if (!$jugador || !$jugador->persona || !$jugador->persona->user) {
            return redirect()->back()->withErrors('Jugador o usuario no encontrado.');
        }
    
        // Cambiar el estado en la tabla users
        if ($jugador->persona->user->activo == 0) {
            $jugador->persona->user->activo = 1;
            $jugador->persona->user->save();
    
            // También cambiar el estado del jugador
            $jugador->activo = 1;
            $jugador->save();
    
            return redirect()->back()->with('success', 'Jugador activado exitosamente.');
        }
    
        return redirect()->back()->withErrors('No se realizaron cambios.');
    }
    

// fin de desactivar y activar
}
 