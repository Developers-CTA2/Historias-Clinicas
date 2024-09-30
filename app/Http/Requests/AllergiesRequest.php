<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllergiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->hasRole('Administrador')) {
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
            'Id_person' => 'nullable|numeric|exists:personas,id_persona',
            'Id' => 'required|numeric|exists:alergias,id_alergia',
            'Description' => 'required|string|max:255',
            'Id_reg' => 'nullable|numeric|exists:persona_alergia,id',
        ];
    }

    public function messages(): array
    {
       return [
            'Id_person.required' => 'El campo ID de la persona es requerido.',
            'Id_person.numeric' => 'El campo ID de la persona debe ser un número.',
            'Id_person.exists' => 'El ID de la persona NO existe.',
            'Id_reg.numeric' => 'El campo ID del registro debe ser numérico.',
            'Id_reg.exists' => 'El campo ID del registro NO existe.',
            'Id.required' => 'El campo ID del la alergia es requerido.',
            'Id.numeric' => 'El campo ID del la alergia es válido.',
            'Id.exists' => 'El campo ID del la alergia no existe.',
            'Description.required' => 'La descripción de la alergia es requerida.',
       ];
    }
}
