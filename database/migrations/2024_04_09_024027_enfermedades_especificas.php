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
            $table->string('created_by', 9);
            $table->string('updated_by', 9)->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermedades_especificas');
    }
};
