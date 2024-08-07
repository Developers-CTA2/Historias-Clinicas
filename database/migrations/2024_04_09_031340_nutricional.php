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
        Schema::create('nutricional', function (Blueprint $table) {
            $table->id('id_nutricional');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->foreignId('id_medida')->constrained('medidas', 'id_medida');
            $table->integer('vasos_agua');
            $table->string('motivo_consulta');
            $table->string('toma_medicamentos');
            $table->text('diagnostico')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('nutricional', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['id_medida']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        }); 

        Schema::dropIfExists('nutricional');
    }
};
