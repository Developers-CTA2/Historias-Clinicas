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
        Schema::create('medidas', function (Blueprint $table) {
            $table->string('peso_actual')->nullable();
            $table->string('peso_habitual')->nullable();
            $table->string('estatura')->nullable();
            $table->string('circunf_cintura')->nullable();
            $table->string('circunf_cadera')->nullable();
            $table->foreignId('id_nutricional')->constrained('nutricional', 'id_nutricional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('medidas');
    }
};
