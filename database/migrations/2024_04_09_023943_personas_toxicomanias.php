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
        Schema::create('personas_toxicomanias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->foreignId('id_toxicomania')->constrained('toxicomanias', 'id');
            $table->string('observacion'); 
            $table->date('desde_cuando')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('personas_toxicomanias', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['id_toxicomania']);
        });

        Schema::dropIfExists('personas_toxicomanias');
    }
};

