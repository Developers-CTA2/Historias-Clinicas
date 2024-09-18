<?php

namespace Database\Factories;

use App\Models\Consulta;
use App\Models\Enfermedad_especifica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultaHasEnfermedad>
 */
class ConsultaHasEnfermedadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $consultas = Consulta::select('id_consulta')->get();
        $enfermedades = Enfermedad_especifica::select('id_especifica_ahf')->get();

        return [
            'id_consulta' => $this->faker->randomElement($consultas)->id_consulta,
            'id_enfermedad' => $this->faker->randomElement($enfermedades)->id_especifica_ahf,
        ];
    }
}
