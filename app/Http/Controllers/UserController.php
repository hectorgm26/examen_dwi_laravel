<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use App\Models\CargosModel;
use App\Models\GeneroModel;
use Illuminate\Http\Request;
use App\Models\PosicionModel;
use App\Models\NacionalidadModel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // Importar el modelo User
use Illuminate\Support\Facades\Hash;  // Importar la fachada Hash
use Illuminate\Validation\Rules\Password;  // Importar la clase Password
use Illuminate\Auth\Events\Registered;  // Opcional, si usas el evento Registered

class UserController extends Controller
{

    /**
     * Helper: crea la cookie con el token JWT
     */
    protected function makeJwtCookie(string $token)
    {
        // TTL en minutos (factory()->getTTL() devuelve minutos)
        $ttl = auth('api')->factory()->getTTL();

        // secure en producción (ajusta si trabajas en localhost con https false)
        $secure = config('app.env') === 'production';

        // cookie(name, value, minutes, path, domain, secure, httpOnly, raw, sameSite)
        return cookie('jwt_token', $token, $ttl, '/', null, $secure, true, false, 'Strict');
    }

    public function showFormRegistro()
    {
        if (Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para crear una nueva.');
        }

        $datos = [
            'textos' => [
                'titulo' => 'Registrar | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/users/registro', $datos);
    }

    public function guardarNuevo(Request $request)
    {

        // 1. Validación de los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'min:9', 'max:10', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], $this->messages);

        // 2. Creación del nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'rut' => $request->rut,
            'password' => Hash::make($request->password),
        ]);

        // 3. Asignar rol "jugador" por defecto
        $rolJugador = Role::where('name', 'jugador')->first();

        if ($rolJugador) {
            $user->assignRole($rolJugador);
        }

        // 4. Generar JWT para el usuario creado (sin loguearlo)
        $token = auth('api')->login($user); // Esto genera un token válido
        $cookie = $this->makeJwtCookie($token);

        // 5. Redirigir al login con mensaje y cookie JWT (el usuario aún no está logueado)
        return redirect()->route('/') // o la ruta de tu formulario de login
            ->with('success', 'Usuario creado exitosamente. Ahora puede iniciar sesión.')
            ->withCookie($cookie);
    }

    public function showFormLogin()
    {
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
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];


        if (Auth::check()) {
            // Si el usuario ya está autenticado, redirígelo a la página principal
            // o a su dashboard.
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para iniciar una nueva.');
        }


        return view('backoffice/users/login', $datos);
    }

    public function login(Request $request)
    {
        // Paso 1: Ver qué llega en la solicitud del formulario
        // dd($request->all());

        $credentials = $request->validate([
            'rut' => ['required'],
            'password' => ['required'],
        ]);

        //dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Generar JWT para el mismo usuario
            $token = auth('api')->login($user);
            $cookie = $this->makeJwtCookie($token);

            return redirect()->route('/')->with('success', "Bienvenido {$user->name}, tiene una sesión iniciada exitosamente.")->withCookie($cookie);
        }

        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Invalidar token JWT guardado en cookie (si existe)
        $token = $request->cookie('jwt_token');
        if ($token) {
            try {
                auth('api')->setToken($token)->invalidate();
            } catch (\Exception $e) {
                // Si falla la invalidación (token expirado u otro), lo ignoramos
            }
        }

        // Borrar cookie
        $forget = Cookie::forget('jwt_token');

        return redirect()->route('/')->with('success', 'Sesión cerrada exitosamente.')->withCookie($forget);
    }

    public function showPerfil()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/users/profile', [
            'datos' => $datos,
            'user' => $user
        ]);
    }

    public function showContacto()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/users/contact', [
            'datos' => $datos,
            'user' => $user
        ]);
    }

    public function showSeguridad()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/users/security', [
            'datos' => $datos,
            'user' => $user
        ]);
    }

    public function cambiarClave(Request $_request)
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $_request->validate([
            'pass_actual' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], $this->messages);

        if (Hash::check($_request->pass_actual, $user->password)) {
            $user->password = Hash::make($_request->password);
            $user->save();
            return redirect()->route('backoffice.user.security')->with('success', 'Contraseña cambiada exitosamente.');
        } else {
            return redirect()->route('backoffice.user.security')->withErrors('Error: Contraseña actual incorrecta.');
        }
    }

    public function index()
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();
        $lista = User::with('roles', 'permissions')->get();
        $roles = Role::all();

        $listaGenero = GeneroModel::all()->where('activo', 1);
        $listaCargos = CargosModel::all()->where('activo', 1);
        $listaNacionalidades = NacionalidadModel::all()->where('activo', 1);
        $listaPosiciones = PosicionModel::all()->where('activo', 1);

        $datos = [
            'textos' => [
                'titulo' => 'Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Usuarios del Sistema',
                'instruccion' => 'Los usuarios del sistema...',
                'routes' => [
                    'new' => 'backoffice.users.new',
                    'update' => 'backoffice.users.update',
                    'up' => 'backoffice.users.up',
                    'down' => 'backoffice.users.down',
                    'delete' => 'backoffice.users.destroy',
                ],
                'fields' => [
                    //rut
                    [
                        'label' => 'RUT (Nombre de usuario)',
                        'name' => 'rut',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 8,
                            'max' => 10,
                            'placeholder' => 'Ingrese el RUT (ej: 12.123.123-4)'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => false,
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
                        ]
                    ],
                    //nombre
                    [
                        'label' => 'Nombre',
                        'name' => 'nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Nombre'
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
                        ]
                    ],
                    //apellido
                    [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Apellido'
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
                        ]
                    ],
                    //fecha de nacimiento
                    [
                        'label' => 'Fecha de Nacimiento',
                        'name' => 'nacimiento',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Apellido'
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
                        ]
                    ],
                    //genero
                    [
                        'label' => 'Género',
                        'name' => 'generoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaGenero,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
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
                        ]
                    ],
                    //cargo
                    [
                        'label' => 'Cargo',
                        'name' => 'cargoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaCargos,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
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
                        ]
                    ],
                    //nacionalidad
                    [
                        'label' => 'Nacionalidad',
                        'name' => 'nacionalidadIds',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaNacionalidades,
                            'type' => 'multiple',
                            'classList' => [
                                'form-select',
                                'mb-4',
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
                        ]
                    ],
                    //posiciones de juego
                    [
                        'label' => 'Posiciones de Juego',
                        'name' => 'posicionesIds',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaPosiciones,
                            'type' => 'multiple',
                            'classList' => [
                                'form-select',
                                'mb-4',
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
                        ]
                    ],
                ],
                'has_roles' => true, // Se agrega para pasarle el rol que tiene el usuario a la vista
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];
        return view('backoffice/users/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $request->validate([
            'rut' => ['required', 'string', 'min:8', 'max:10'],
            'nombre' => ['required', 'string', 'min:3', 'max:50'],
            'apellido' => ['required', 'string', 'min:3', 'max:50'],
            'nacimiento' => ['required', 'date'],
            'generoId' => ['required', 'integer'],
            'cargoId' => ['required', 'integer'],
            //'nacionalidadIds' => ['required', 'array'],
            //'posicionesIds' => ['required', 'array'],
        ], $this->messages);


        // dd($request->all());

        $nuevo = User::create([
            'rut' => $request->rut,
            'name' => $request->nombre,
            'lastname' => $request->apellido,
            'fechaNacimiento' => $request->nacimiento,
            'generoId' => $request->generoId,
            'cargoId' => $request->cargoId,
            // 'nacionalidadIds' => $request->nacionalidadIds,
            // 'posicionesIds' => $request->posicionesIds,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Asignar el rol, en base al cargo elegido en el formulario de creacion de usuario
        // Buscar el cargo elegido
        $cargo = CargosModel::find($request->cargoId);

        if ($cargo) {
            $rolName = strtolower($cargo->nombre);
            $rol = Role::where('name', $rolName)->first();

            if ($rol) {
                $nuevo->assignRole($rol); // asigna rol según cargo
            } else {
                // Si no existe rol según cargo, asigna "jugador" por defecto
                $rolJugador = Role::where('name', 'jugador')->first();
                if ($rolJugador) {
                    $nuevo->assignRole($rolJugador);
                }
            }
        }

        return redirect()->back()->with('success', ':) Usuario creado exitosamente.');
    }
}
