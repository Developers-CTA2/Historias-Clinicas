<?php

namespace Database\Seeders;

use App\Models\Consulta;
use App\Models\ConsultaHasEnfermedad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Consulta::factory(100)->create();
        ConsultaHasEnfermedad::factory(40)->create();
    }
}
