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
        Schema::create('indicadores_dietéticos', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->integer('comidas_al_dia');     
            $table->string('qien_prepara_comida');
            $table->enum('apetito', ['Bueno', 'Malo', 'Regular']);
            $table->string('alimentos_no_preferidos')->nullable();
            $table->string('suplementos')->nullable();
            $table->string('grasas_consumidas')->nullable();
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

        Schema::table('indicadores_dietéticos', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('indicadores_dietéticos');
    }
};
