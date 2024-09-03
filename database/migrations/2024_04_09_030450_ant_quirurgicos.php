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
        Schema::create('ant_quirurgicos', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->string('fecha')->nullable();
            $table->string('detalles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // Eliminar restricciones de clave foránea
        Schema::table('ant_quirurgicos', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
        });

        Schema::dropIfExists('ant_quirurgicos');
    }
};
