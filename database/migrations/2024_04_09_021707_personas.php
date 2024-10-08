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
            $table->foreignId('domicilio_id')->constrained('domicilio', 'id_domicilio');
            $table->foreignId('hemotipo_id')->constrained('hemotipo', 'id_hemotipo');
            $table->foreignId('escolaridad_id')->constrained('escolaridad', 'id_escolaridad');
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
          
            $table->string('religion', 50);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Eliminar la relación de la tabla personas con la tabla users
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign(['domicilio_id']);
            $table->dropForeign(['hemotipo_id']);
            $table->dropForeign(['escolaridad_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('personas');
    }
};
