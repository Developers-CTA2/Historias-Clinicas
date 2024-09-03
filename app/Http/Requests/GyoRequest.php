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
            'Data.met' => 'required|string',
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
            'Id_persona.required' => 'El ID de la persona es requerido.',
            'Id_persona.numeric' => 'El ID de la persona no es válido.',
            'Id_persona.exists' => 'El ID de la persona no existe.',
            'Id_reg.required' => 'El ID del registro de GYO es requerido.',
            'Id_reg.numeric' => 'El ID del registro de GYO no es válido.',
            'Id_reg.exists' => 'El ID del registro de GYO no existe.',
            'Data.menarca.required' => 'El dato de menarca es requerido.',
            'Data.menarca.numeric' => 'El dato de menarca no es válido.',
            'Data.menstruacion.required' => 'La fecha de U.M es requerida.',
            'Data.menstruacion.date' => 'El dato de U.M no es válido.',
            'Data.gest.required' => 'El dato de S. gestación es requerido.',
            'Data.gest.numeric' => 'El dato de S. debe no es válido.',
            'Data.ciclos.required' => 'El dato tipo de cliclos es requerido.',
            'Data.dias_1.required' => 'El dato de dias X días es requerido.',
            'Data.dias_1.numeric' => 'El dato de dias X días no es válido.',
            'Data.dias_2.required' => 'El dato de dias X días es requerido.',
            'Data.dias_2.numeric' => 'El dato de dias X días no es válido.',
            'Data.last_c.required' => 'El dato última citología es requerido.',
            'Data.last_c.numeric' => 'El dato última citología no es válido.',
            'Data.mast.required' => 'El dato última mastografía es requerido.',
            'Data.met.string' => 'El dato de método de planificación es requerido.',
            'Data.inicio.required' => 'El dato inicio de vida sexual es requerido.',
            'Data.inicio.numeric' => 'El dato inicio de vida sexual no es válido.',
            'Data.parejas.required' => 'El dato núm. parejas es requerido.',
            'Data.parejas.numeric' => 'El dato núm. parejas no es válido.',
            'Data.gestas.required' => 'El dato núm. gestas es requerido.',
            'Data.gestas.numeric' => 'El dato núm. gestas no es válido.',
            'Data.partos.required' => 'El dato núm. partos es requerido.',
            'Data.partos.numeric' => 'El dato núm. partos no es válido.',
            'Data.cesareas.required' => 'El dato núm. cesareas es requerido.',
            'Data.cesareas.numeric' => 'El dato núm. cesareas no es válido.',
            'Data.abortos.required' => 'El dato núm. abortos es requerido.',
            'Data.abortos.numeric' => 'El dato núm. abortos no es válido.',
        ];
    }
}
