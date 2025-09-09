<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->foreignId('genero_id')->nullable()->constrained('genero')->onDelete('set null');
            //$table->string('correo')->unique();
            //$table->string('telefono')->nullable();
            //$table->string('direccion')->nullable();
            //$table->foreignId('comuna_id')->nullable()->constrained('comunas')->onDelete('set null');
            $table->foreignId('oficios_id')->nullable()->constrained('oficios')->onDelete('set null');
            //$table->foreignId('medio_contacto_id')->nullable()->constrained('medio_contacto')->onDelete('set null');
            $table->foreignId('nacionalidad_id')->nullable()->constrained('nacionalidad')->onDelete('set null');
            $table->integer('edad')->nullable();
            $table->timestamps();
        });

        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->unique()->constrained('persona')->onDelete('cascade');
            // Clave foránea a pierna_dominante
            $table->foreignId('pierna_dominante_id')
                ->constrained('pierna_dominante')
                ->onDelete('restrict');
            // Clave foránea a posiciones
            $table->foreignId('posiciones_id')
                ->constrained('posiciones')
                ->onDelete('restrict');
            // Clave foránea a camisetas
            $table->foreignId('camisetas_id')
                ->constrained('camisetas')
                ->onDelete('restrict');
            // Estado activo
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('entrenador');
            $table->string('jugador');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('campeonato', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('ubicacion')->nullable();
            $table->foreignId('comunaId')
                ->constrained('comuna');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('campeonatos_equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('campeonatoId');
            $table->integer('equipoId');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        
        Schema::create('equipo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
        Schema::dropIfExists('jugadores');
        Schema::dropIfExists('persona');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('campeonato');
        Schema::dropIfExists('campeonatos_equipos');
    }
};
