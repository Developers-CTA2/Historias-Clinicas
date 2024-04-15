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
        Schema::create('consulta', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('turno')->nullable();
            $table->string('nombre_medico')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('tratamiento')->nullable();
            $table->string('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('consulta');
    }
};
