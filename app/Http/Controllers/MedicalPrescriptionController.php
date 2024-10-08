<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Folio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MedicalPrescriptionController extends Controller
{

    // Generate a new medical prescription for a patient PDF
    public function generateMedicalPrescription($id_persona, $id_consulta)
    {

        $patient = Persona::select('id_persona', 'nombre', 'fecha_nacimiento')->findOrFail($id_persona);
        $consultation = $patient->consulta()->select('id_consulta', 'tratamiento', 'created_at', 'id_folio', 'created_by')->findOrFail($id_consulta);

        $user = auth()->user();



        // return response()->json($consultation);

        // $doctor = User::with('roles')
        //     ->whereHas('roles', function ($query) {
        //         $query->where('name', 'Administrador');
        //     })
        //     ->where('estado', 'Activo')
        //     ->select('id', 'name', 'cedula')
        //     ->first();

        if ($user->roles[0]->id !== 1) {
            $doctor = User::with('roles')
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'Administrador');
                })
                ->where('estado', 'Activo')
                ->where('super_user', 1)
                ->select('id', 'name', 'cedula')
                ->first();
            
        } else {
            $doctor = $consultation
                ->user()
                ->select('id', 'name', 'cedula')->first();
        }

        // return response()->json($doctor);

        // Check if the patient has a folio
        if ($consultation->id_folio == null) {

            DB::transaction(function () use ($consultation, $patient) {
                // Create a new folio for the patient
                $folio = new Folio();
                $folio->type = 'medical-prescription';
                $folio->id_persona = $patient->id_persona;
                $folio->save();

                $consultation->update(['id_folio' => $folio->id]);
            });
        }

        $patient->age = Carbon::parse($patient->fecha_nacimiento)->age;
        $folio = $consultation->id_folio;

        // return response()->json(compact('patient', 'consultation', 'doctor', 'folio'));

        $pdf = PDF::loadView('patients.medical_prescription.format-cualtos', compact('patient', 'consultation', 'doctor'));
        return $pdf->download('folio-' . $folio . '.pdf');
    }
}
