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
            $table->integer('cesarias');
            $table->date('fecha_citologia');
            $table->string('metodo');
            $table->date('mastografia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('gyo');
    }
};
