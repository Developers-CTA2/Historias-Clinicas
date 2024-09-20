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
        Schema::create('folios', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['medical-prescription', 'nutrition-prescription', 'other']);
            $table->foreignId('id_persona')->constrained('personas', 'id_persona');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('folios', function (Blueprint $table){
            $table->dropForeign(['id_persona']);
        });

        Schema::dropIfExists('folios');
    }
};
