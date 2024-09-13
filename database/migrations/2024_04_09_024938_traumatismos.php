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
        Schema::create('traumatismos', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->date('fecha')->nullable();
            $table->string('detalles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Eliminar restricciones de clave foránea
        Schema::table('traumatismos', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
        });
        Schema::dropIfExists('traumatismos');
    }
};
