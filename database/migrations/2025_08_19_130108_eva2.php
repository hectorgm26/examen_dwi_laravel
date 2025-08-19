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
    }
};
