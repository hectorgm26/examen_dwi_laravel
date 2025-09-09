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
        Schema::create('recintos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->string('ubicacion')->nullable(); // Agrega esta línea
            $table->timestamps();
        });

        Schema::create('camisetas', function (Blueprint $table) {
            $table->id();
            $table->integer('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('hora_inicio', function (Blueprint $table) {
            $table->id();
            $table->time('nombre')->unique(); // ← Aquí
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('hora_fin', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('medios_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255)->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('posiciones', function (Blueprint $table) {
            $table->id();
            $table->string('abreviatura')->unique();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('dias_semana', function (Blueprint $table) {
            $table->id();
            $table->String('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('nacionalidad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('pais_origen')->notNullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('oficios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('genero', function (Blueprint $table) {
            $table->id();
            $table->string('icono')->nullable();
            $table->string('nombre', 50);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('pierna_dominante', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('medio_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('aside', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('ruta')->unique();
            $table->string('icono');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recintos');
        Schema::dropIfExists('camisetas');
        Schema::dropIfExists('comunas');
        Schema::dropIfExists('hora_inicio');
        Schema::dropIfExists('hora_fin');
        Schema::dropIfExists('medios_pagos');
        Schema::dropIfExists('premios');
        Schema::dropIfExists('posiciones');
        Schema::dropIfExists('campeonato');
        Schema::dropIfExists('dias_semana');
        Schema::dropIfExists('nacionalidad');
        Schema::dropIfExists('oficios');
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('genero');
        Schema::dropIfExists('pierna_dominante');
        Schema::dropIfExists('aside');
        Schema::dropIfExists('medio_contacto');
    }
};
