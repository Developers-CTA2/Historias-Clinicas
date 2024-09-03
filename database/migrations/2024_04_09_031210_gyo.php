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
        Schema::create('gyo', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->integer('menarca');
            $table->date('fecha_um');
            $table->string('s_gestacion',100)->nullable();
            $table->enum('ciclos', ['Regular', 'Irregular']);
            $table->string('dias_x_dias', 100);
            $table->integer('ivs');
            $table->integer('parejas_s');
            $table->integer('gestas');
            $table->integer('partos');
            $table->integer('abortos');
            $table->integer('cesareas');
            $table->string('fecha_citologia',4);
            $table->string('metodo');
            $table->string('mastografia',4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('gyo', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
        });

        Schema::dropIfExists('gyo');
    }
};
