<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required|numeric|exists:users,id',
            'email' => 'required|email',
            'cedula' => 'nullable|numeric|digits_between:7,8',
            'userType' => 'required|numeric|in:1,2,3',
            'estado' => 'required|string',
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
            'id.required' => 'El Id del usuario es requerido',
            'id.numeric' => 'El Id del usuario debe ser un número',
            'id.exists' => 'El Id no pertenece a ningún usuario',
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo debe ser válido',
            'cedula.numeric' => 'La cédula debe ser numérica',
            'cedula.length' => 'La cédula debe tener entre 7 u 8 dígitos',
            'userType.required' => 'El tipo de usuario es requerido',
            'userType.numeric' => 'El tipo de usuario debe ser numérico',
            'userType.in' => 'El tipo de usuario no es válido, por favor seleccione uno de la lista',
            'estado.required' => 'El estado del usuario es requerido',
        ];
    }
}
