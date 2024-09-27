<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalDataRequest extends FormRequest
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
            'Type' => 'required|numeric|between:1,3',
            'Id_dom' => 'required|numeric',
            'Id' => 'required|numeric|exists:personas,id_persona',
            'Direction.country' => 'required|string',
            'Direction.state' => 'required|numeric|exists:rep_estado,id_estado',
            'Direction.city' => 'required|string',
            'Direction.colony' => 'required|string',
            'Direction.cp' => 'required|digits_between:5,5',
            'Direction.street' => 'required|string',
            'Direction.ext' => 'required|numeric',
            'Direction.int' => 'nullable|string|max:255',
            'Personal.name' => 'required|string|max:255',
            'Personal.tel' => 'required|digits_between:10,15',
            'Personal.gender' => 'required|string',
            'Personal.birthday' => 'required|date',
            'Personal.religion' => 'required|string|max:255',
            'Personal.ocupation' => 'required|string|max:255',
            'Personal.nss' =>'required|digits_between:11,11',
            'Personal.name_e' => 'required|string|max:255',
            'Personal.tel_e' => 'required|string|digits_between:10,15',
            'Personal.parent_e' => 'required|string|max:255',
            'Personal.school' => 'required|numeric|exists:escolaridad,id_escolaridad',
        ];
    }

    public function messages(): array
    {
        return [
            'Type.required' => 'No se recibio el dato de tipo de acción.',
            'Type.numeric' => 'El tipo de acción debe ser numérico.',
            'Type.between' => 'El tipo de accióndebe ser un numero entre 1 y 3.',
            'Id_dom.required' => 'El ID del domicilio es requerido.',
            'Id_dom.numeric' => 'El ID del domicilio debe ser un numérico.',
            'Id_dom.exist' => 'El ID del domicilio no existe en la base de datos.',
            'Id.Id' => 'El campo ID de la persona es requerido.',
            'Id.numeric' => 'El campo ID de la persona debe ser numérico.',
            'Id.exists' => 'El campo ID de la persona no existe en la base de datos.',
            'Direction.country.required' => 'El campo país es requerido.',
            'Direction.country.string' => 'El campo país debe ser una cadena de texto.',
            'Direction.country.max' => 'El campo país debe temer maximo 255 caracteres.',
            'Direction.country.max' => 'El campo país debe temer maximo 255 caracteres.',
            'Direction.state.required' => 'El campo de estado es requerido.',
            'Direction.state.numeric' => 'El campo de estado debe ser numérico.',
            'Direction.state.exists' => 'El campo de estado no existe en la base de datos.',
            'Direction.city.required' => 'El campo de ciudad es requerido.',
            'Direction.city.max' => 'El campo de ciudad debe tener máximo 255 caracteres.',
            'Direction.colony.required' => 'El campo de colonia es requerido.',
            'Direction.cp.required' => 'El campo de código postal es requerido.',
            'Direction.cp.digits_between' => 'El campo de código postal debe tener entre 7 y 9 dígitos.',
            'Direction.street.required' => 'El campo de calle es requerido.',
            'Direction.ext.required' => 'El campo de número exterior es requerido.',
            'Direction.ext.numeric' => 'El campo de número exterior debe ser numérico.',
            'Direction.int.max' => 'El campo de número int debe tener máximo 255 caracteres.',
            'Direction.name.required' => 'El campo de nombre es requerido.',
            'Direction.name.max' => 'El campo de nombre debe tener máximo 255 caracteres.',
            'Direction.tel.max' => 'El campo de teléfono es requerido.',
            'Direction.tel.digits_between' => 'El campo de teléfono debe tener entre 10 y 15 dígitos.',
            'Direction.gender.required' => 'El campo de género es requerido.',
            'Direction.birthday.required' => 'El campo de fecha de nacimiento es requerido.',
            'Direction.birthday.date' => 'El campo de fecha de nacimiento es inválido.',
            'Direction.religion.date' => 'El campo de religión es requerido.',
            'Direction.religion.max' => 'El campo de religión debe tener máximo 255 caracteres.',
            'Direction.ocupation.required' => 'El campo de ocupation es requerido.',
            'Direction.ocupation.max' => 'El campo de ocupation debe tener máximo 255 caracteres.',
            'Direction.nss.required' => 'El campo de NSS es requerido.',
            'Direction.nss.digits_between' => 'El campo de NSS deben ser 11 dígitos.',
            'Direction.name_e.required' => 'El campo de nombre del emergencia es requerido.',
            'Direction.name_e.max' => 'El campo de nombre del emergencia debe tener máximo 255 caracteres.',
            'Direction.tel_e.required' => 'El campo de teléfono de emergencia es requerido.',
            'Direction.tel_e.digits_between' => 'El campo de teléfono de emergencia debe tener entre 10 y 15 dígitos.',
            'Direction.parent_e.required' => 'El campo de parentesco es requerido.',
            'Direction.parent_e.max' => 'El campo de parentesco debe tener máximo 255 caracteres.',
            'Direction.school.required' => 'El campo de escolaridad es requerido.',
            'Direction.school.numeric' => 'El campo de escolaridad debe ser numérico.',
            'Direction.school.exists' => 'El campo de escolaridad no existe en la base de datos.',
          ];
    }
}
