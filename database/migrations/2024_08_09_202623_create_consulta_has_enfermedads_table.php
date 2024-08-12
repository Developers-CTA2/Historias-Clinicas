<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consulta_has_enfermedades', function (Blueprint $table) {
            $table->foreignId('id_consulta')->constrained('consulta','id_consulta');
            $table->foreignId('id_enfermedad')->constrained('enfermedades_especificas', 'id_especifica_ahf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consulta_has_enfermedades', function (Blueprint $table) {
            $table->dropForeign(['id_consulta']);
            $table->dropForeign(['id_enfermedad']);
        });

        Schema::dropIfExists('consulta_has_enfermedades');
    }
};
