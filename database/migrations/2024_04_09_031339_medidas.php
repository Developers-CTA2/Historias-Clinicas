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
            $table->id('id_medida');
            $table->double('peso_actual');
            $table->double('peso_habitual');
            $table->double('estatura');
            $table->double('circunferencia_cintura');
            $table->double('circunferencia_cadera');
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
