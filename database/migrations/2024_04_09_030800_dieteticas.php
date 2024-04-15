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
        Schema::create('dieteticas', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->string('comidas_dia')->nullable();
            $table->string('quien_prepara')->nullable();
            $table->string('come_entre_c')->nullable();
            $table->string('apetito')->nullable();
            $table->string('alim_pref')->nullable();
            $table->string('alim_no_pref')->nullable();
            $table->string('alergia')->nullable();
            $table->string('alergia_a_que')->nullable();
            $table->string('suplementos')->nullable();
            $table->string('vasos_agua')->nullable();
            $table->string('vasos_bebidas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dieteticas');
    }
};
