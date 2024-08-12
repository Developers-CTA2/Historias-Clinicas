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
            $table->id('id_domicilio'); // Asegúrate de que sea una clave primaria
            $table->string('cuidad_municipio');
            $table->foreignId('estado_id')->constrained('rep_estado', 'id_estado');
            $table->string('pais');
            $table->string('calle');
            $table->string('num');
            $table->string('num_int')->nullable();
            $table->string('colonia');
            $table->string('cp');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
            $table->dropForeign(['estado_id']);

            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

         

        Schema::dropIfExists('domicilio');
    }
};
