<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('codigo')->nullable();
            $table->string('nombre');
            $table->string('domiclio');
            $table->string('ocupacion');
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->string('telefono');
            $table->string('telefono_emerge');
            $table->string('contacto_emerge');
            $table->string('nss');
            $table->string('fecha_registro');
            $table->string('religion');
            $table->string('usuario_reg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
