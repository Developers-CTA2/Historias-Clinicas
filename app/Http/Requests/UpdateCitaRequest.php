<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitaRequest extends FormRequest
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
            'nameEdit' => 'required|string|max:255',
            'phoneEdit' => 'required|digits:10',
            'emailEdit' => 'required|email|max:255',
            'typeProfessionalEdit' => 'required|in:Doctora,Nutrióloga',
            'fecha' => 'required|date_format:Y-m-d',
            'hourEdit' => 'required|date_format:H:i',
            'reasonEdit' => 'required|max:255',
            'statusEdit' => 'required|exists:estatus_cita,id',
        ];
    }

  
    public function messages(): array
    {
        return [
            'nameEdit.required' => 'El nombre es requerido',
            'nameEdit.string' => 'El nombre no cumple con el formato',
            'nameEdit.max' => 'El nombre no debe exceder los 255 caracteres',
            'phoneEdit.required' => 'El teléfono es requerido',
            'phoneEdit.string' => 'El teléfono debe contener solo números',
            'phoneEdit.size' => 'El teléfono debe tener 10 dígitos',
            'emailEdit.email' => 'El correo electrónico no es válido',
            'emailEdit.max' => 'El correo electrónico no debe exceder los 255 caracteres',
            'typeProfessionalEdit.required' => 'El tipo de profesional es requerido',
            'typeProfessionalEdit.in' => 'El tipo de profesional no es válido',
            'fecha.required' => 'La fecha es requerida',
            'fecha.date_format' => 'La fecha no tiene un formato válido',
            'hourEdit.required' => 'La hora es requerida',
            'hourEdit.date_format' => 'La hora no tiene un formato válido',
            'reasonEdit.required' => 'El motivo es requerido',
            'reasonEdit.max' => 'El motivo no debe exceder los 255 caracteres',
            'statusEdit.required' => 'El estatus es requerido',
            'statusEdit.exists' => 'El estatus no es válido',
        ];
    }
}
