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
        Schema::create('emprendimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('emprendedor_id');
            $table->string('nombre');
            $table->string('cuit')->default('S/CUIT');
            $table->string('domicilio')->default('S/Domicilio');
            $table->boolean('afip')->default(false);
            $table->boolean('ater')->default(false);
            $table->boolean('afim')->default(false);
            $table->date('habilitacion')->nullable();
            $table->string('rubro')->default('Gastronómico');
            $table->boolean('activo')->default(true);
            $table->string('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprendimientos');
    }
};
