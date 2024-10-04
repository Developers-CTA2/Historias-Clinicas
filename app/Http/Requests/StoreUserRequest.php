<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user()->hasRole('Administrador')){
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
            'name' => 'required|string',
            'code' => 'required|numeric|digits_between:7,9',
            'email' => 'required|email',
            'cedula' => 'nullable|numeric|digits_between:7,8',
            'userType' => 'required|numeric|in:1,2,3',
            'file' => 'required|mimes:pdf|max:2048',
            'sex' => 'required|in:Masculino,Femenino',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'code.required' => 'El código es requerido',
            'code.numeric' => 'El código debe ser numérico',
            'code.digits_between' => 'El código debe tener entre 7 y 9 dígitos',
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo debe ser válido',
            'cedula.numeric' => 'La cédula debe ser numérica',
            'cedula.length' => 'La cédula debe tener entre 7 u 8 dígitos',
            'userType.required' => 'El tipo de usuario es requerido',
            'userType.numeric' => 'El tipo de usuario debe ser numérico',
            'userType.in' => 'El tipo de usuario no es válido, por favor seleccione uno de la lista',
            'file.required' => 'El archivo es requerido',
            'file.mimes' => 'El archivo debe ser un PDF',
            'file.max' => 'El archivo debe pesar menos de 2MB',
            'sex.required' => 'El sexo es requerido',
            'sex.in' => 'El sexo no es válido, por favor seleccione uno de la lista',
        ];
    }
}
