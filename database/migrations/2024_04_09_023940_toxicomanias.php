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
        Schema::create('toxicomanias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120);
            $table->foreignId('created_by')->constrained('users')->default(0);
            $table->foreignId('updated_by')->constrained('users')->default(null);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('toxicomanias', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('toxicomanias');
    }
};
