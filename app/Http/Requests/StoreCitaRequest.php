<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'correo' => 'required|email|max:255',
            'tipo_profesional' => 'required|in:Doctora,Nutrióloga',
            'hora' => 'required|date_format:H:i',
            'fecha' => 'required|date_format:Y-m-d',
            'motivo' => 'required'
        ];
    }

    public function messages(): array {

        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre tiene un formato inválido',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres',
            'telefono.required' => 'El teléfono es requerido',
            'telefono.digits' => 'El teléfono debe contener solo números',
            'telefono.size' => 'El teléfono debe tener 10 dígitos',
            'correo.required' => 'El correo es requerido',
            'correo.email' => 'El correo debe ser una dirección de correo válida',
            'correo.max' => 'El correo debe ser una dirección de correo válida',
            'tipo_profesional.required' => 'El tipo de profesional es requerido',
            'tipo_profesional.in' => 'El tipo de profesional debe ser Doctora o Nutrióloga',
            'hora.required' => 'La hora es requerida',
            'hora.date_format' => 'La hora debe cumplir con el formato HH:MM',
            'motivo.required' => 'El motivo es requerido',
        ];

    }
}
