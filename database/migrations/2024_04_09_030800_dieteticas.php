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
            $table->integer('comidas_dia');
           // $table->string('quien_prepara')->nullable();
          //  $table->string('come_entre_c')->nullable();}     
            $table->enum('apetito', ['Bueno', 'Malo', 'Regular']);
           // $table->string('alim_pref')->nullable();
            $table->string('alim_no_pref')->nullable();
            $table->string('alergias')->nullable();
            $table->string('suplementos')->nullable();
            $table->integer('vasos_agua');
            $table->string('vasos_bebidas');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('dieteticas', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
        });

        Schema::dropIfExists('dieteticas');
    }
};
