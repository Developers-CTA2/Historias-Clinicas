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
        Schema::create('domicilio', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->string('cuidad_municipio');
            $table->string('estado');
            $table->string('pais');
            $table->string('calle');
            $table->string('num');
            $table->string('num_int')->nullable();
            $table->string('colonia');
            $table->string('cp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // Eliminar restricciones de clave foránea
        Schema::table('domicilio', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
        });

        Schema::dropIfExists('domicilio');
    }
};
