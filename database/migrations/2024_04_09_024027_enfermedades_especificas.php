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
        Schema::create('enfermedades_especificas', function (Blueprint $table) {
            $table->id('id_especifica_ahf');
            $table->foreignId('id_tipo_ahf')->constrained('tipos_enfermedades', 'id_tipo_ahf');
            $table->string('nombre', 150);
            $table->foreignId('created_by')->constrained('users')->nullable();
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enfermedades_especificas', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('enfermedades_especificas');
    }
};
