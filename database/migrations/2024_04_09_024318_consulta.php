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
            $table->enum('turno',['matutino','vespertino','nocturno']);
            $table->text('motivo_consulta');
            $table->text('auxiliares_dx_tx_previo')->nullable();
            $table->text('exploracion_fisica');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('observaciones')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->softDeletes();
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
