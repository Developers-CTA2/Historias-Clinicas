<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddictionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->hasRole('Administrador') || $this->user()->hasRole('Prestador de medicina') || $this->user()->hasRole('Prestador de nutrición')) {
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
            'IdPerson' => 'nullable|numeric|exists:personas,id_persona',
            'Data.idReferenceTable' => 'required|numeric|exists:toxicomanias,id',
            'Data.date' => 'required|numeric',
            'Data.description' => 'required|string',
            'Data.descriptionUI' => 'required|string', 
        ];
    }
    public function messages(): array
    {
        return [
            'IdPerson.numeric' => 'El ID de la persona no es válido.',
            'IdPerson.exists' => 'El ID de la persona no existe.',
            'idReferenceTable.required' => 'El ID de la toxicomanía es requerido.',
            'idReferenceTable.numeric' => 'El ID de la toxicomanía no es válido.',
            'idReferenceTable.exists' => 'El ID de la toxicomanía no es existe.',
            'date.required' => 'El dato desde cuándo es requerido.',
            'date.numeric' => 'El dato desde cuándo no es válido.',
            'description.required' => 'La descripción es un campo requerido.',
            'descriptionUI.required' => 'La descripción es un campo requerido.',
    
        ];
    }
}
