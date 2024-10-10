<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AHFRequest extends FormRequest
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
            'Id_reg' => 'nullable|numeric|exists:persona_ahf,id',
            'Id_ahf' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            'Id_person' => 'nullable|numeric|exists:personas,id_persona'
        ];
    }

      public function messages(): array
    {
        return [
            'Id_reg.numeric' => 'El campo ID (ahf) del registro debe ser un numérico.',
            'Id_reg.exists' => 'El campo ID (ahf) del registro NO existe.',
            'Id_ahf.required' => 'El campo ID de la enfermedad es requerido.',
            'Id_ahf.numeric' => 'El campo ID de la enfermedad no es válido.',
            'Id_ahf.exists' => 'El campo ID de la enfermedad no existe.',
            'Id_person.numeric' => 'El campo ID de la persona debe ser numérico.',
            'Id_person.exists' => 'El campo ID de la persona NO existe.',
        ];
        
    }
}
