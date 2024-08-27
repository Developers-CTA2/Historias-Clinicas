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
        Schema::create('persona_alergia', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->foreignId('id_alergia')->constrained('alergias', 'id_alergia');
            $table->string('especificar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('persona_alergia', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['id_alergia']);
        });

        Schema::dropIfExists('persona_alergia');
    }
};
