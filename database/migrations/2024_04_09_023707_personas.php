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
            $table->string('nombre')->notNullable();
            $table->string('domiclio')->nullable();
            $table->string('ocupacion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('contacto_emerge')->nullable();
            $table->string('nss')->nullable();
            $table->string('fecha_registro')->nullable();
            $table->string('religion')->nullable();
            $table->string('usuario_reg')->nullable();
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
