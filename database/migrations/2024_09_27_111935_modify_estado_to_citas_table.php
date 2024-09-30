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
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->foreignId('estatus_cita_id')->nullable()->constrained('estatus_cita');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['estatus_cita_id']);
            $table->dropColumn('estatus_cita_id');
            $table->string('estado', 50);
        });
    }
};
