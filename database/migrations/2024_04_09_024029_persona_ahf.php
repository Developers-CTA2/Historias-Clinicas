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
        Schema::create('persona_ahf', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->foreignId('id_ahf')->constrained('enfermedades_especificas', 'id_especifica_ahf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('persona_ahf', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['id_ahf']);
        });

        Schema::dropIfExists('persona_ahf');
    }
};  
