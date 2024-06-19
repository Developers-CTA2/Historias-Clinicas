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
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->date('fecha')->nullable();
            $table->string('motivo_consul')->nullable();
            $table->id('id_nutricional');
            $table->string('diagnostico')->nullable();
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
        }); 

        Schema::dropIfExists('nutricional');
    }
};
