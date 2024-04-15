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
            $table->string('cuidad_municipio')->nullable();
            $table->string('calle')->nullable();
            $table->string('num')->nullable();
            $table->string('num_int')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domicilio');
    }
};
