<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MedicalPrescriptionController extends Controller
{
    
    // Generate a new medical prescription for a patient PDF
    public function generateMedicalPrescription($id_persona, $id_consulta){
        
        $patient = Persona::select('id_persona','nombre','fecha_nacimiento', 'created_at')->findOrFail($id_persona);
        $consultation = $patient->consulta()->select('tratamiento')->findOrFail($id_consulta);

        $patient->age = Carbon::parse($patient->fecha_nacimiento)->age;

        // dd($patient, $consultation);

        // return response()->json([
        //     'patient' => $patient,
        //     'consultation' => $consultation
        // ]);
        
        $pdf = PDF::loadView('patients.medical_prescription.format-cualtos', compact('patient', 'consultation'));
        return $pdf->stream('prescripcion-medica.pdf');

    }

}
