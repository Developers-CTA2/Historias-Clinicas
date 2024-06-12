<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CitasController extends Controller
{
    public function agenda()
    {
        $breadcrumbs = [
            ['name' => 'Agenda', 'url' => ''],
        ];

        return view('admin.agenda', compact('breadcrumbs'));
    }

    public function proximaCita()
    {
        // Obtener la próxima cita ordenada por fecha y hora ascendentes
        $proximaCita = Citas::orderBy('fecha', 'asc')->orderBy('hora', 'asc')->first();
        
        // Verificar si hay una próxima cita
        if ($proximaCita) {
            // Retornar un array con la hora y el nombre de la persona
            return response()->json([
                'hora' => $proximaCita->hora,
                'nombre' => $proximaCita->pacientes->nombre,
                'fecha' => $proximaCita->fecha, // Agrega la fecha aquí
            ]);
        } else {
            // Si no hay próxima cita, devolver un mensaje de error
            return response()->json(['error' => 'No hay próxima cita'], 404);
        }
    }

    public function mostrarCitas(Request $request)
    {
        $fecha = $request->query('fecha');
        if (!$fecha) {
            return redirect('/')->with('error', 'Fecha no proporcionada');
        }
    
        // Obtener las citas ordenadas por hora ascendente
        $citas = Citas::whereDate('fecha', $fecha)
                        ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
                        ->orderBy('hora', 'asc')
                        ->get();
    
        $breadcrumbs = [
            ['name' => 'Citas', 'url' => ''],
        ];
    
        return view('admin.citas', [
            'fecha' => $fecha,
            'citas' => $citas,
        ], compact('breadcrumbs', 'fecha', 'citas'));
    }



    public function guardarCita(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'telefono' => 'required|string',
                'email' => 'nullable|email|unique:pacientes,email',
                'tipo_profesional' => 'required|in:Doctora,Nutrióloga',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'motivo' => 'required|string',
            ]);

            $paciente = Pacientes::create([
                'nombre' => $request->input('nombre'),
                'telefono' => $request->input('telefono'),
                'email' => $request->input('email')
            ]);

            // Crear nueva cita con el ID del paciente
            Citas::create([
                'paciente_id' => $paciente->id,
                'tipo_profesional' => $request->input('tipo_profesional'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora'),
                'motivo' => $request->input('motivo'),
            ]);

            return redirect()->route('showAgenda')->with('success', 'Cita agregada correctamente.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error al guardar la cita: ' . $e->getMessage());
            // Redirect back with error message
            return redirect()->back()->with('error', 'Error al guardar la cita. Por favor, inténtalo de nuevo.');
        }
    }
}
