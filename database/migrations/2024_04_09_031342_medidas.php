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
            $table->double('peso_actual');
            $table->double('peso_habitual');
            $table->double('estatura');
            $table->double('circunf_cintura');
            $table->double('circunf_cadera');
            $table->foreignId('id_nutricional')->constrained('nutricional', 'id_nutricional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('medidas', function (Blueprint $table) {
            $table->dropForeign(['id_nutricional']);
        });

        Schema::dropIfExists('medidas');
    }
};
