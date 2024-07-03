<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user()->hasRole('Administrador') || $this->user()->hasRole('Prestador de medicina') || $this->user()->hasRole('Prestador de nutrición')){
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
          
          'frecuenciaCardiaca' => 'required|numeric|between:30,220',
          'presionArterial' => 'required|string',
          'temperatura' => 'required|numeric|between:35,42',
          'pesoKilogramos' => 'required|numeric|between:5,300',
          'frecuenciaRespiratoria' => 'required|numeric|between:10,60',
          'satPorcentaje' => 'required|numeric|between:1,100',
          'glucosa' => 'required|numeric|between:1,500',
           'talla' => 'required|numeric|between:1,300',
           'reason' => 'required|string',
           'aux' => 'nullable',
           'physical_exam'=> 'required|string',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'observations' => 'nullable',
        ];
    }

    public function messages() : array
    {
        return [
            'frecuenciaCardiaca.required' => 'La frecuencia cardiaca es requerida',
            'frecuenciaCardiaca.numeric' => 'La frecuencia cardiaca debe ser un número',
            'frecuenciaCardiaca.between' => 'La frecuencia cardiaca debe estar entre 30 y 220',
            'presionArterial.required' => 'La presión arterial es requerida',
            'presionArterial.numeric' => 'La presión arterial debe ser un número',
            'presionArterial.between' => 'La presión arterial debe estar entre 60 y 140',
            'temperatura.required' => 'La temperatura es requerida',
            'temperatura.numeric' => 'La temperatura debe ser un número',
            'temperatura.between' => 'La temperatura debe estar entre 35 y 42',
            'pesoKilogramos.required' => 'El peso en kilogramos es requerido',
            'pesoKilogramos.numeric' => 'El peso en kilogramos debe ser un número',
            'pesoKilogramos.between' => 'El peso en kilogramos debe estar entre 5 y 300',
            'frencuenciaRespiratoria.required' => 'La frecuencia respiratoria es requerida',
            'frencuenciaRespiratoria.numeric' => 'La frecuencia respiratoria debe ser un número',
            'frencuenciaRespiratoria.between' => 'La frecuencia respiratoria debe estar entre 10 y 60',
            'satPorcentaje.required' => 'La saturación de oxígeno es requerida',
            'satPorcentaje.numeric' => 'La saturación de oxígeno debe ser un número',
            'satPorcentaje.between' => 'La saturación de oxígeno debe estar entre 1 y 100',
            'glucosa.required' => 'La glucosa es requerida',
            'glucosa.numeric' => 'La glucosa debe ser un número',
            'glucosa.between' => 'La glucosa debe estar entre 1 y 500',
            'talla.required' => 'La talla es requerida',
            'talla.numeric' => 'La talla debe ser un número',
            'talla.between' => 'La talla debe estar entre 1 y 300',
        ];
        
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id_persona = $this->route('id_persona');

            if (!is_numeric($id_persona) || $id_persona <= 0) {
                $validator->errors()->add('id_persona', 'El ID de la persona debe ser un número entero positivo.');
            }

            // Verifica si el id_persona existe en la base de datos
            if (!\App\Models\Persona::find($id_persona)) {
                $validator->errors()->add('id_persona', 'El ID de la persona no existe, por favor recarga la página.');
            }
        });
    }
}
