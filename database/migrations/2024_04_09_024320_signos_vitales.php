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
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->foreignId('id_consulta')->constrained('consulta','id_consulta');
            $table->integer('frecuencia_cardiaca');
            $table->integer('ritmo_respiratorio');
            $table->string('presion_arterial',10);
            $table->decimal('peso');
            $table->decimal('temperatura');
            $table->integer('sindrome_autoinmune_tirogastrico');
            $table->integer('glucosa');
            $table->decimal('talla');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('signos_vitales', function (Blueprint $table) {
            $table->dropForeign(['id_consulta']);
        });

        Schema::dropIfExists('signos_vitales');
    }
};
