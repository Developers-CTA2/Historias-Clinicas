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
        Schema::create('hospitalizaciones', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->string('fecha')->nullable();
            $table->string('detalles')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hospitalizaciones');
    }
};
