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
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('codigo', 9)->nullable();
            $table->string('nombre', 120);
            $table->string('ocupacion', 50);
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('telefono', 10);
            $table->string('telefono_emerge', 10);
            $table->string('contacto_emerge', 120);
            $table->string('parentesco_emerge', 60);
            $table->string('nss',12);
            $table->date('fecha_registro');
            $table->string('escolaridad', 50);
            $table->string('religion', 50);
            $table->string('created_by', 9);
            $table->string('updated_by', 9)->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->string('updated_by', 9)->nullable();   
            $table->date('fecha_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
