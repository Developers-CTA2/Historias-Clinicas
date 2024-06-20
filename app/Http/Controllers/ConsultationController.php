<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function create(){

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.patients')],
            ['name' => 'Nueva consulta', '' => ''],
        ];

        return view('patients.newConsultation', compact('breadcrumbs'));

    }
}
