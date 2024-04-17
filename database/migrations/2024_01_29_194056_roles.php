<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /// Crear los roles 
        $role1 = Role::create(['id' => 1, 'name' => 'Administrador']);
        $role2 = Role::create(['id' => 2, 'name' => 'Prestador de medicina']);
        $role3 = Role::create(['id' => 3, 'name' => 'Prestador de nutrición']);
        $role4 = Role::create(['id' => 4, 'name' => 'Paciente']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('roles'); 
    }
};
