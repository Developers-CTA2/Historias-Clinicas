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
        Schema::create('estilo_vida', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->enum('actividad',['Sedentaria','Muy ligera','Ligera','Moderada','Pesada','Excepcional']);
            $table->string('tipo_ejercicio');
            $table->string('frecuencia_ejercicio');
            $table->string('duracion_ejercicio');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('estilo_vida', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('estilo_vida');
    }
};
