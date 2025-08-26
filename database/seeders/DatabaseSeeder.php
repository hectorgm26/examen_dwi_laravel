<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //   'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        DB::table('users')->insert([
            [
                'name' => 'Sebastián',
                'lastname' => 'Cabezas',
                'rut' => '12345678-9',
                'password' => Hash::make('holaMundo'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('roles')->insert([
            [
                'nombre' => 'Admin',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Common',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('cargos')->insert([
            [
                'nombre' => 'Entrenador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Jugador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('genero')->insert([
            [
                'icono' => 'ti tabler-gender-female',
                'nombre' => 'Femenino',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icono' => 'ti tabler-gender-male',
                'nombre' => 'Masculino',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //oficios: hector
        DB::table('oficios')->insert([
            [
                'nombre' => 'Carpintero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Programador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Gasfiter',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Doctor',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Abogado',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Contador Auditor',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Enfermero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Electrico',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Soldador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ingeniero Comercial',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Temporero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        //posiciones: ethan
        DB::table('posiciones')->insert([
            [
                'abreviatura' => 'POR',
                'nombre' => 'Portero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'LD',
                'nombre' => 'Lateral Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'LI',
                'nombre' => 'Lateral Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'CAD',
                'nombre' => 'Carrilero Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'CAI',
                'nombre' => 'Carrilero Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'DFC',
                'nombre' => 'Defensa Central',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MCD',
                'nombre' => 'Mediocentro Defensivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MC',
                'nombre' => 'Mediocentro',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MCO',
                'nombre' => 'Mediocentro Ofensivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MD',
                'nombre' => 'Medio Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MI',
                'nombre' => 'Medio Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'ED',
                'nombre' => 'Extremo Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'EI',
                'nombre' => 'Extremo Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'DC',
                'nombre' => 'Delantero Centro',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'SD',
                'nombre' => 'Segundo Delantero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
        //premios: Luciano
        DB::table('premios')->insert([
            [
                'nombre' => 'Set Parrillero Artesanal',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Parrilla a Carbón',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Botella 750ml Jack Daniels',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Copa de Plata',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Medallas doradas',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Premio Mvp de la Final',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Zapatillas Nike Mercurial',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //categorias: robert
        DB::table('categoria')->insert([
            [
                'nombre' => 'Senior (Professional)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Senior (Amateur)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sub-20',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sub-23',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (5-7 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (8-9 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (10-11 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (12-13 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (14-15 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (16-18 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Medios de pago: Miguel
        DB::table('medios_pagos')->insert([
            [
                'nombre' => 'Efectivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Transferencia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Paypal',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WebPayDebito',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WebPayCredito',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'MercadoPago',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cheque',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Comunas: Santos
        DB::table('comunas')->insert([
            [
                'nombre' => 'Arica',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Camarones',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Putre',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'San Bernardo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Pierna Buena: Vicente
        DB::table('pierna_dominante')->insert([
            [
                'nombre' => 'Derecha',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Izquierda',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Hora Inicio: Jean Piere
        DB::table('hora_inicio')->insert([
            [
                'nombre' => '18:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '18:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Hora Término: Gerard
        DB::table('hora_fin')->insert([
            [
                'nombre' => '19:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '21:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '21:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Medios de Contacto: Justin
        DB::table('medio_contacto')->insert([
            [
                'nombre' => 'Email',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Telefono',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WhatsApp',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Instagram',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Facebook',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Twitter',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Aside: Justin
        DB::table('aside')->insert([
            [
                'nombre' => 'Roles',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.roles.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
