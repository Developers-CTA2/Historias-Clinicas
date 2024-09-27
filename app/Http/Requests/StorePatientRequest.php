<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePatientRequest extends FormRequest
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
            'type' => 'required|string|max:255', // 'Paciente' o 'Empleado
            'code' => 'required_if:type,udg,digits_between:7,9',
            'name' => 'required|string|max:255',
            'career' => 'required|string|max:255',
            'gender' => 'required|numeric|between:1,2',
            'birthdate' => 'required|date',
            'bloodType' => 'required|exists:hemotipo,id_hemotipo',
            'phone' => 'required|digits_between:10,15',
            'nss' => 'required|digits_between:11,11',
            'civilStatus' => 'required|numeric|between:1,5',
            'religion' => 'required|string|max:255',
            'dependency' => 'required|string|max:255',
            'state' => 'required|exists:rep_estado,id_estado',
            'city' => 'required|string|max:255',
            'scholarship' => 'required|exists:escolaridad,id_escolaridad',
            'colony' => 'required|string|max:255', 
            'cp' => 'required|digits_between:5,5',
            'street' => 'required|string|max:255',
            'number' => 'required|numeric',
            'intNumber' => 'nullable|string:max:20',
            'emergencyPhone' => 'required|digits_between:10,15',    
            'emergencyName' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'listHereditaryFamilialDiseases' => 'nullable|array',
            'listHereditaryFamilialDiseases.*.id' => 'nullable|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            'listDrugAddiction' => 'nullable|array',
            'listDrugAddiction.*.idReferenceTable' => 'nullable|numeric|exists:toxicomanias,id',
            'listDrugAddiction.*.date' => 'nullable|string|max:255',
            'listDrugAddiction.*.description' => 'nullable|string|max:255',
            'listPathologicalHistory' => 'nullable|array',
            'listPathologicalHistory.*.idReferenceTable' => 'nullable|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            'listPathologicalHistory.*.type' => 'nullable|string',
            'listPathologicalHistory.*.value' => 'nullable|required_if:listPathologicalHistory.*.type,hospitalizacion,date',
            'listPathologicalHistory.*.value' => 'nullable|required_if:listPathologicalHistory.*.type,cirugia,date',
            'listPathologicalHistory.*.value' => 'nullable|required_if:listPathologicalHistory.*.type,transfusion,date',
            'listPathologicalHistory.*.value' => 'nullable|required_if:listPathologicalHistory.*.type,traumatismo,date',
            'listPathologicalHistory.*.reason' => 'nullable|required_if:listPathologicalHistory.*.type,alergia,string,max:255',
            'listGynecologyObstetrics' => 'required_if:gender,2',
            'listGynecologyObstetrics.menarca' => 'required_if:gender,2,numeric,between:1,100',
            'listGynecologyObstetrics.fum' => 'required_if:gender,2,date',
            'listGynecologyObstetrics.numPartos' => 'required_if:gender,2,numeric,between:1,50',
            'listGynecologyObstetrics.numCesareas' => 'required_if:gender,2,numeric,between:1,50',  
            'listGynecologyObstetrics.numAbortos' => 'required_if:gender,2,numeric,between:1,50',
            'listGynecologyObstetrics.diasSangrado' => 'required_if:gender,2,numeric,between:1,50',
            'listGynecologyObstetrics.diasCiclo' => 'required_if:gender,2,numeric,between:1,50',
            'listGynecologyObstetrics.fechaCitologia' => 'required_if:gender,2,numeric,between:4,4',
            'listGynecologyObstetrics.mastografia' => 'required_if:gender,2,numeric,between:4,4',
            'listGynecologyObstetrics.inicioVidaSexual' => 'required_if:gender,2,numeric,between:1,100',
            'listGynecologyObstetrics.metodoDescriptivo' => 'required_if:gender,2,string,max:255',
            'listGynecologyObstetrics.estaEmbarazada' => 'required_if:gender,2,boolean',
            
        ];
    }

    public function messages() : array {
        return[
            'code.required_if' => 'El campo código es requerido',
            'code.digits_between' => 'El campo código debe tener entre 7 y 9 dígitos',
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'El campo nombre debe ser una cadena de texto',
            'name.max' => 'El campo nombre debe tener máximo 255 caracteres',
            'career.required' => 'El campo carrera es requerido',
            'career.string' => 'El campo carrera debe ser una cadena de texto',
            'career.max' => 'El campo carrera debe tener máximo 255 caracteres',
            'gender.required' => 'El campo género es requerido',
            'birthdate.required' => 'El campo fecha de nacimiento es requerido',    
            'birthdate.date' => 'El campo fecha de nacimiento debe ser una fecha',
            'bloodType.required' => 'El campo tipo de sangre es requerido',
            'phone.required' => 'El campo teléfono es requerido',
            'phone.digits_between' => 'El campo teléfono debe tener entre 10 y 15 dígitos',
            'nss.required' => 'El campo número de seguro social es requerido',
            'nss.digits_between' => 'El campo número de seguro social debe tener 11 dígitos',
            'scholarship' => 'El campo escolaridad es requerido',
            'scholarship.numeric' => 'No se ha seleccionado una escolaridad válida',
            'scholarship.between' => 'No se ha seleccionado una escolaridad válida',    
            'civilStatus.required' => 'El campo estado civil es requerido',
            'civilStatus.numeric' => 'No se ha seleccionado un estado civil válido',
            'civilStatus.between' => 'No se ha seleccionado un estado civil válido',
            'religion.required' => 'El campo religión es requerido',    
            'religion.string' => 'El campo religión debe ser una cadena de texto',
            'religion.max' => 'El campo religión debe tener máximo 255 caracteres',
            'dependecy.required' => 'El campo dependencia es requerido',
            'dependecy.string' => 'El campo dependencia debe ser una cadena de texto',
            'dependecy.max' => 'El campo dependencia debe tener máximo 255 caracteres',
            'state.required' => 'El campo estado es requerido',
            'state.string' => 'El campo estado debe ser una cadena de texto',
            'state.max' => 'El campo estado debe tener máximo 255 caracteres',
            'city.required' => 'El campo ciudad es requerido',
            'city.string' => 'El campo ciudad debe ser una cadena de texto',
            'city.max' => 'El campo ciudad debe tener máximo 255 caracteres',
            'colony.required' => 'El campo colonia es requerido',
            'colony.string' => 'El campo colonia debe ser una cadena de texto',
            'colony.max' => 'El campo colonia debe tener máximo 255 caracteres',
            'cp.required' => 'El campo código postal es requerido',
            'cp.digits_between' => 'El campo código postal debe tener 5 dígitos',
            'street.required' => 'El campo calle es requerido',
            'street.string' => 'El campo calle debe ser una cadena de texto',
            'street.max' => 'El campo calle debe tener máximo 255 caracteres',
            'number.required' => 'El campo número es requerido',
            'number.numeric' => 'El campo número de la casa debe ser un número',
            'intNumber.required' => 'El campo número interior es requerido',
            'intNumber.string' => 'El campo número interior debe tener el formato correcto',
            'cp.required' => 'El campo código postal es requerido',
            'cp.digits_between' => 'El campo código postal debe tener 5 dígitos',
            'emergencyPhone.required' => 'El campo teléfono de emergencia es requerido',
            'emergencyPhone.digits_between' => 'El campo teléfono de emergencia debe tener entre 10 y 15 dígitos',
            'emergencyName.required' => 'El campo nombre de emergencia es requerido',
            'emergencyName.string' => 'El campo nombre de emergencia debe ser una cadena de texto',
            'emergencyName.max' => 'El campo nombre de emergencia debe tener máximo 255 caracteres',
            'relationship.required' => 'El campo parentesco es requerido',
            'relationship.string' => 'El campo parentesco debe ser una cadena de texto',
            'relationship.max' => 'El campo parentesco debe tener máximo 255 caracteres',
            'listHereditaryFamilialDiseases.required' => 'El campo lista de enfermedades heredo-familiares es requerido',
            'listHereditaryFamilialDiseases.array' => 'El campo lista de enfermedades heredo-familiares debe ser un arreglo',
            'listHereditaryFamilialDiseases.*.id.required' => 'El campo id de enfermedad heredo-familiar es requerido',
            'listHereditaryFamilialDiseases.*.id.numeric' => 'El campo id de enfermedad heredo-familiar debe ser un número',
            'listHereditaryFamilialDiseases.*.id.exists' => 'El campo id de enfermedad heredo-familiar no existe',
            'listDrugAddiction.required' => 'El campo lista de toxicomanías es requerido',
            'listDrugAddiction.*.idReferenceTable.required' => 'El campo id de toxicomanía es requerido',
            'listDrugAddiction.*.idReferenceTable.numeric' => 'El campo id de toxicomanía debe ser un número',
            'listDrugAddiction.*.idReferenceTable.exists' => 'El campo id de toxicomanía no existe',
            'listPathologicalHistory.required' => 'El campo lista de antecedentes patológicos es requerido',
            'listPathologicalHistory.*.idReferenceTable.required' => 'El campo id de antecedente patológico es requerido',
            'listPathologicalHistory.*.idReferenceTable.numeric' => 'El campo id de antecedente patológico debe ser un número',
            'listPathologicalHistory.*.idReferenceTable.exists' => 'El campo id de antecedente patológico no existe',
            'listPathologicalHistory.*.type.required' => 'El campo tipo de antecedente patológico es requerido',    
            'listGynecologyObstetrics.required_if' => 'El campo lista de ginecología y obstetricia es requerido',
            'listGynecologyObstetrics.menarca.required_if' => 'El campo menarca es requerido',
            'listGynecologyObstetrics.menarca.numeric' => 'El campo menarca debe ser un número',
            'listGynecologyObstetrics.menarca.between' => 'El campo menarca debe ser un número entre 1 y 100',
            'listGynecologyObstetrics.fum.required_if' => 'El campo fecha de última menstruación es requerido',
            'listGynecologyObstetrics.fum.date' => 'El campo fecha de última menstruación debe ser una fecha',
            'listGynecologyObstetrics.numGestas.required_if' => 'El campo número de gestas es requerido',
            'listGynecologyObstetrics.numGestas.numeric' => 'El campo número de gestas debe ser un número',
            'listGynecologyObstetrics.numGestas.between' => 'El campo número de gestas debe ser un número entre 1 y 50',
            'listGynecologyObstetrics.numPartos.required_if' => 'El campo número de partos es requerido',
            'listGynecologyObstetrics.numPartos.numeric' => 'El campo número de partos debe ser un número',
            'listGynecologyObstetrics.numPartos.between' => 'El campo número de partos debe ser un número entre 1 y 50',
            'listGynecologyObstetrics.numCesareas.required_if' => 'El campo número de cesáreas es requerido',
            'listGynecologyObstetrics.numCesareas.numeric' => 'El campo número de cesáreas debe ser un número',
            'listGynecologyObstetrics.numCesareas.between' => 'El campo número de cesáreas debe ser un número entre 1 y 50',
            'listGynecologyObstetrics.numAbortos.required_if' => 'El campo número de abortos es requerido',
            'listGynecologyObstetrics.numAbortos.numeric' => 'El campo número de abortos debe ser un número',   
            'listGynecologyObstetrics.numAbortos.between' => 'El campo número de abortos debe ser un número entre 1 y 50',
            'listGynecologyObstetrics.diasSangrado.required_if' => 'El campo días de sangrado es requerido',
            'listGynecologyObstetrics.diasSangrado.numeric' => 'El campo días de sangrado debe ser un número',  
            'listGynecologyObstetrics.diasSangrado.between' => 'El campo días de sangrado debe ser un número entre 1 y 50', 
            'listGynecologyObstetrics.diasCiclo.required_if' => 'El campo días de ciclo es requerido',
            'listGynecologyObstetrics.diasCiclo.numeric' => 'El campo días de ciclo debe ser un número',
            'listGynecologyObstetrics.diasCiclo.between' => 'El campo días de ciclo debe ser un número entre 1 y 50',   
            'listGynecologyObstetrics.fechaCitologia.required_if' => 'El campo fecha de citología es requerido',
            'listGynecologyObstetrics.fechaCitologia.numeric' => 'El campo fecha de citología debe ser un número',
            'listGynecologyObstetrics.fechaCitologia.between' => 'El campo fecha de citología debe ser un número de 4 dígitos',
            'listGynecologyObstetrics.mastografia.required_if' => 'El campo mastografía es requerido',
            'listGynecologyObstetrics.mastografia.numeric' => 'El campo mastografía debe ser un número',
            'listGynecologyObstetrics.mastografia.between' => 'El campo mastografía debe ser un número de 4 dígitos',   
            'listGynecologyObstetrics.inicioVidaSexual.required_if' => 'El campo inicio de vida sexual es requerido',
            'listGynecologyObstetrics.inicioVidaSexual.numeric' => 'El campo inicio de vida sexual debe ser un número',
            'listGynecologyObstetrics.inicioVidaSexual.between' => 'El campo inicio de vida sexual debe ser un número entre 1 y 100',   
            'listGynecologyObstetrics.metodoDescriptivo.required_if' => 'El campo método descriptivo es requerido',
            'listGynecologyObstetrics.metodoDescriptivo.string' => 'El campo método descriptivo debe ser una cadena de texto',
            'listGynecologyObstetrics.metodoDescriptivo.max' => 'El campo método descriptivo debe tener máximo 255 caracteres',
            'listGynecologyObstetrics.estaEmbarazada.required_if' => 'El campo está embarazada es requerido',  
            'listGynecologyObstetrics.estaEmbarazada.boolean' => 'El campo está embarazada debe ser un booleano',   
        ];
    }
}
