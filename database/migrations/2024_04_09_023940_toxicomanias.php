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

    public function down()
    {
        Schema::dropIfExists('toxicomanias');
    }
};
