<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNutritionMedicalRecordRequest extends FormRequest
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
            'comidas_al_dia' => 'required|integer',
            'qien_prepara_comida' => 'required|string',
            'apetito' => 'required|string',
            'alimentos_no_preferidos' => 'nullable|string',
            'suplementos' => 'nullable|string',
            'grasas_consumidas' => 'nullable|string',
            'actividad' => 'required|string',
            'tipo_ejercicio' => 'required|string',
            'frecuencia_ejercicio' => 'required|string',
            'duracion_ejercicio' => 'required|string',
        ];
    }

    public function messages() : array
    {
        return [
            'id_persona.required' => 'El id de la persona es requerido',
            'id_persona.numeric' => 'El id de la persona debe ser un número',
            'id_persona.exists' => 'El id de la persona no existe',
            'comidas_al_dia.required' => 'El número de comidas al día es requerido',
            'comidas_al_dia.integer' => 'El número de comidas al día debe ser un número entero',
            'qien_prepara_comida.required' => 'Quién prepara la comida es requerido',
            'qien_prepara_comida.string' => 'Quién prepara la comida debe ser una cadena de texto',
            'apetito.required' => 'El apetito es requerido',
            'apetito.string' => 'El apetito debe ser una cadena de texto',
            'alimentos_no_preferidos.string' => 'Los alimentos no preferidos deben ser una cadena de texto',
            'suplementos.string' => 'Los suplementos deben ser una cadena de texto',
            'grasas_consumidas.string' => 'Las grasas consumidas deben ser una cadena de texto',
            'actividad.required' => 'La actividad es requerida',
            'actividad.string' => 'La actividad debe ser una cadena de texto',
            'tipo_ejercicio.required' => 'El tipo de ejercicio es requerido',
            'tipo_ejercicio.string' => 'El tipo de ejercicio debe ser una cadena de texto',
            'frecuencia_ejercicio.required' => 'La frecuencia de ejercicio es requerida',
            'frecuencia_ejercicio.string' => 'La frecuencia de ejercicio debe ser una cadena de texto',
            'duracion_ejercicio.required' => 'La duración de ejercicio es requerida',
            'duracion_ejercicio.string' => 'La duración de ejercicio debe ser una cadena de texto',
        ];
    }
}
