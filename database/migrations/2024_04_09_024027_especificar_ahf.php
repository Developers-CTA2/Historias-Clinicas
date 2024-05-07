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
        Schema::create('especificar_ahf', function (Blueprint $table) {
            $table->id('id_especifica_ahf');
            $table->foreignId('id_tipo_ahf')->nullable()->constrained('tipo_ahf', 'id_tipo_ahf');
            $table->string('nombre')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especificar_ahf');
    }
};
