<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Consulta;

class PatientsController extends Controller
{
    public function show(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Persona::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%$search%")
                    ->orWhere('nombre', 'like', "%$search%")
                    ->orWhere('sexo', 'like', "%$search%");
            });
        }

        $count = $query->count();
        $data = $query->with('consulta')->offset($offset)->limit($limit)->get();

        // Mapear los datos para incluir la fecha de la última consulta
        $formattedData = $data->map(function ($paciente) {
            return [
                'id' => $paciente->id_persona,
                'codigo' => $paciente->codigo,
                'nombre' => $paciente->nombre,
                'sexo' => $paciente->sexo,
                'consulta' => optional($paciente->consulta->last())->fecha ?? 'N/A',
            ];
        });

        return response()->json(['results' => $formattedData, 'count' => $count]);
    }


    public function breadCrumb()
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', '' => ''],
        ];
        
        return view('admin.seePatient', compact('breadcrumbs'));
    }
}


