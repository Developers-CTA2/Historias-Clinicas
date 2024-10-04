<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageAPPRequest extends FormRequest
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
            'Id_person' => 'nullable|numeric',
            'Description' => 'required|string|max:255',
            'Date' => 'required|date',
            // 'Id_hosp' => 'nullable|numeric|exists:hospitalizaciones,id',
        ];
    }

    /*
    El campo 'Id_person' --> si es Add si pertenece a ID persona 
    En caso de un update pertenece al ID del registro ejemplo hospitalizaciones, transfuciones, etc
    */
    public function messages(): array
    {
        return [
            'Id_person.required' => 'El parámetro ID es requerido.',
            'Id_person.numeric' => 'El parámetro ID debe ser numérico.',
            //  'Id_person.exists' => 'El campo ID de la persona NO existe.',
            'Date.required' => 'La fecha del dato es requerida.',
            'Date.date' => 'La fecha del no tiene un formato valido.',
            'Description.required' => 'La descripción es requerida.',
            'Description.max' => 'La descripción no debe sobrepasar los 255 caráctres.',
        ];
    }
}
