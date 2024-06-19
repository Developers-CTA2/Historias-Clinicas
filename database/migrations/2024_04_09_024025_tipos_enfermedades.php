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
        Schema::create('tipos_enfermedades', function (Blueprint $table) {
            $table->id('id_tipo_ahf');
            $table->string('nombre', 150);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        // Schema::table('tipos_enfermedades', function (Blueprint $table) {
        //     $table->dropForeign(['created_by']);
        //     $table->dropForeign(['updated_by']);
        // });

        Schema::dropIfExists('tipos_enfermedades');
    }
};
