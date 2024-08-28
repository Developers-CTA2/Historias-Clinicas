<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\Folio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Carbon\Carbon;

class MedicalPrescriptionController extends Controller
{
    
    // Generate a new medical prescription for a patient PDF
    public function generateMedicalPrescription($id_persona, $id_consulta){
        
        $patient = Persona::select('id_persona','nombre','fecha_nacimiento', 'created_at')->findOrFail($id_persona);
        $consultation = $patient->consulta()->select('tratamiento','id_folio')->findOrFail($id_consulta);

    
        $doctor = User::with('roles')
            ->whereHas('roles', function($query){
                $query->where('name','Administrador');
            })
            ->where('estado','Activo')
            ->select('id','name','cedula')
            ->first();


        // Check if the patient has a folio
        if($consultation->folio == null){

            // Create a new folio for the patient
            $folio = new Folio();
            $folio->type = 'medical-prescription';
            $folio->id_persona = $patient->id_persona;
            $folio->save();

            // return response()->json($folio);

            // Assign the folio to the consultation
            $consultation->id_folio = $folio->id;
            $consultation->save();
            
        }


        $patient->age = Carbon::parse($patient->fecha_nacimiento)->age;

                
        $pdf = PDF::loadView('patients.medical_prescription.format-cualtos', compact('patient', 'consultation','doctor'));
        return $pdf->download('prescripcion-medica'. $patient->id_person .'.pdf');

    }

}
