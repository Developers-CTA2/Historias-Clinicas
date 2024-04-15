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
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->foreignId('id_consulta')->constrained('consulta','id_consulta');
            $table->decimal('temperatura')->nullable();
            $table->string('frecuencia_car')->nullable();
            $table->string('ritmo_resp')->nullable();
            $table->string('presion_art')->nullable();
            $table->decimal('peso')->nullable();
            $table->string('glucosa')->nullable();
            $table->decimal('talla')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('signos_vitales');
    }
};
