<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GyoRequest extends FormRequest
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
            'Id_persona' => 'required|numeric|exists:personas,id_persona',
            'Id_reg' => 'required|numeric|exists:gyo,id',
            'Data.menarca' => 'required|numeric',
            'Data.menstruacion' => 'required|date',
            'Data.gest' => 'required|numeric',
            'Data.ciclos' => 'required|string',
            'Data.dias_1' => 'required|numeric',
            'Data.dias_2' => 'required|numeric',
            'Data.last_c' => 'required|numeric',
            'Data.mast' => 'required|numeric',
            'Data.met' => 'required|string|max:255',
            'Data.inicio' => 'required|numeric',
            'Data.parejas' => 'required|numeric',
            'Data.gestas' => 'required|numeric',
            'Data.partos' => 'required|numeric',
            'Data.cesareas' => 'required|numeric',
            'Data.abortos' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'Id_persona.required' => 'El campo ID de la persona es requerido.',
            'Id_persona.numeric' => 'El campo ID de la persona debe ser numérico.',
            'Id_persona.exists' => 'El campo ID de la persona NO existe.',
            'Id_reg.required' => 'El campo ID del registro de GYO es requerido.',
            'Id_reg.numeric' => 'El campo ID del registro de GYO debe ser numérico.',
            'Id_reg.exists' => 'El campo ID del registro de GYO no existe.',
            'Data.menarca.required' => 'El campo de menarca es requerido.',
            'Data.menarca.numeric' => 'El campo de menarca no es válido.',
            'Data.menstruacion.required' => 'La fecha de U.M es requerida.',
            'Data.menstruacion.date' => 'El campo de U.M debe ser una fecha.',
            'Data.gest.required' => 'El campo de S. gestación es requerido.',
            'Data.gest.numeric' => 'El campo de S. debe ser numérico.',
            'Data.ciclos.required' => 'El campo tipo de cliclos es requerido.',
            'Data.dias_1.required' => 'El campo de dias X días es requerido.',
            'Data.dias_1.numeric' => 'El campo de dias X días debe ser numérico.',
            'Data.dias_2.required' => 'El campo de dias X días es requerido.',
            'Data.dias_2.numeric' => 'El campo de dias X días debe ser numérico.',
            'Data.last_c.required' => 'El campo última citología es requerido.',
            'Data.last_c.numeric' => 'El campo última citología debe ser numérico.',
            'Data.mast.required' => 'El campo última mastografía es requerido.',
             'Data.met.max' => 'El campo de método no debe exceder los 255 caracteres.',
            'Data.inicio.required' => 'El campo inicio de vida sexual es requerido.',
            'Data.inicio.numeric' => 'El campo inicio de vida sexual debe ser numérico.',
            'Data.parejas.required' => 'El campo núm. parejas es requerido.',
            'Data.parejas.numeric' => 'El campo núm. parejas debe ser numérico.',
            'Data.gestas.required' => 'El campo núm. gestas es requerido.',
            'Data.gestas.numeric' => 'El campo núm. gestas debe ser numérico.',
            'Data.partos.required' => 'El campo núm. partos es requerido.',
            'Data.partos.numeric' => 'El campo núm. partos debe ser numérico.',
            'Data.cesareas.required' => 'El campo núm. cesáreas es requerido.',
            'Data.cesareas.numeric' => 'El campo núm. cesáreas debe ser numérico.',
            'Data.abortos.required' => 'El campo núm. abortos es requerido.',
            'Data.abortos.numeric' => 'El campo núm. abortos debe ser numérico.',
        ];
    }
}
