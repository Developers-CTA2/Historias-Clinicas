<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $persons = Persona::select('id_persona')->get();
        $id = auth()->user()->id;


        return [
            'id_persona' => $this->faker->randomElement($persons)->id_persona,
            'fecha' => $this->faker->date(),
            'turno' => $this->faker->randomElement(['matutino','vespertino','nocturno']),
            'motivo_consulta' => $this->faker->text(),  
            'auxiliares_dx_tx_previo' => $this->faker->text(),
            'exploracion_fisica' => $this->faker->text(),
            'diagnostico' => $this->faker->text(),
            'tratamiento' => $this->faker->text(),
            'observaciones' => $this->faker->text(),
            'created_by' => $id,
            'updated_by' => $id,
        ];
    }
}
