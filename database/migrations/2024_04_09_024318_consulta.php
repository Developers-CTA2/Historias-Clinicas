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
        Schema::create('consulta', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->date('fecha');
            $table->time('hora');
            $table->string('turno', 20);
            $table->string('nombre_medico');
            $table->string('diagnostico');
            $table->string('tratamiento');
            $table->string('observaciones');
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
        Schema::table('consulta', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

      Schema::dropIfExists('consulta');
    }
};
