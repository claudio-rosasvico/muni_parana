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
        Schema::create('emprendedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('user_id');
            $table->string('nro_expediente');
            $table->integer('anio_expediente');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('DNI')->default('S/DNI');
            $table->date('fecha_nac')->default('1960-01-01');
            $table->string('domicilio')->default('S/Domicilio');
            $table->string('telefono');
            $table->string('email');
            $table->string('venc_carnet')->default('1960-01-01');
            $table->boolean('activo')->default(true);
            $table->boolean('CUD')->default(false);
            $table->string('observaciones')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprendedores');
    }
};
