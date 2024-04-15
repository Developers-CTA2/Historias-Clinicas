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
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->foreignId('id_toxicomania')->constrained('toxicomanias', 'id');
            $table->string('cantidad')->nullable();
            $table->date('desde_cuando')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('personas_toxico');
    }
};

