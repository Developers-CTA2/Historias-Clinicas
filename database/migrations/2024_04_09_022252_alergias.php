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
        Schema::create('alergias', function (Blueprint $table) {
            $table->id('id_alergia');
            $table->string('nombre')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->default(0);
            $table->foreignId('updated_by')->constrained('users')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alergias', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('alergias');
    }
};
