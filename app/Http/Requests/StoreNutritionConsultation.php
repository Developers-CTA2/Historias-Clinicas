<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNutritionConsultation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if($this->user()->hasRole('Prestador de nutrición')){
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_persona' => 'required|numeric|exists:personas,id_persona',
            'vasos_agua' => 'required|integer',
            'motivo_consulta' => 'required|string',
            'toma_medicamentos' => 'required|string',
            'diagnostico' => 'nullable|string',
            'peso_actual' => 'required|numeric',
            'peso_habitual' => 'required|numeric',
            'estatura' => 'required|numeric',
            'circunferencia_cintura' => 'required|numeric',
            'circunferencia_cadera' => 'required|numeric',
        ];
    }

    public function messages() : array
    {
         return [
            'id_persona.required' => 'El campo id_persona es requerido',
            'id_persona.numeric' => 'El campo id_persona debe ser un número',
            'id_persona.exists' => 'El campo id_persona no existe en la tabla personas',
            'vasos_agua.required' => 'El campo vasos_agua es requerido',
            'vasos_agua.integer' => 'El campo vasos_agua debe ser un número entero',
            'motivo_consulta.required' => 'El campo motivo_consulta es requerido',
            'motivo_consulta.string' => 'El campo motivo_consulta debe ser una cadena de texto',
            'toma_medicamentos.required' => 'El campo toma_medicamentos es requerido',
            'toma_medicamentos.string' => 'El campo toma_medicamentos debe ser una cadena de texto',
            'diagnostico.string' => 'El campo diagnostico debe ser una cadena de texto',
            'peso_actual.required' => 'El campo peso_actual es requerido',
            'peso_actual.numeric' => 'El campo peso_actual debe ser un número',
            'peso_habitual.required' => 'El campo peso_habitual es requerido',
            'peso_habitual.numeric' => 'El campo peso_habitual debe ser un número',
            'estatura.required' => 'El campo estatura es requerido',
            'estatura.numeric' => 'El campo estatura debe ser un número',
            'circunferencia_cintura.required' => 'El campo circunferencia_cintura es requerido',
            'circunferencia_cintura.numeric' => 'El campo circunferencia_cintura debe ser un número',
            'circunferencia_cadera.required' => 'El campo circunferencia_cadera es requerido',
            'circunferencia_cadera.numeric' => 'El campo circunferencia_cadera debe ser un número',
         ];
          
    }
}
