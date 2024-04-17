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
            $table->string('menarca')->nullable();
            $table->date('fecha_um')->nullable();
            $table->string('c_regulares')->nullable();
            $table->string('diasxdias')->nullable();
            $table->string('ivs')->nullable();
            $table->string('parejas_s')->nullable();
            $table->integer('gestas')->nullable();
            $table->integer('partos')->nullable();
            $table->integer('abortos')->nullable();
            $table->integer('cesarias')->nullable();
            $table->date('fecha_citologia')->nullable();
            $table->string('metodo')->nullable();
            $table->integer('mastografia')->nullable();
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
