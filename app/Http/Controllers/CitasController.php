<?php

namespace App\Http\Controllers;

use App\Mail\ConsultaMail;
use App\Mail\EditarConsultaMail;

use App\Models\Citas;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


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
        try {
            // Obtener la fecha y hora actuales
            $now = \Carbon\Carbon::now();

            // Obtener todas las citas desde la fecha y hora actuales ordenadas por fecha y hora ascendentes
            $todasLasCitas = Citas::where(function ($query) use ($now) {
                $query->where('fecha', '>', $now->format('Y-m-d'))
                    ->orWhere(function ($query) use ($now) {
                        $query->where('fecha', '=', $now->format('Y-m-d'))
                            ->where('hora', '>', $now->format('H:i'));
                    });
            })
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->get();

            // Inicializar un array para almacenar la próxima cita de cada día
            $proximasCitasPorDia = [];

            // Iterar sobre todas las citas para filtrar la próxima cita de cada día
            foreach ($todasLasCitas as $cita) {
                // Asegurarse de que la fecha sea un objeto Carbon
                $fecha = \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d');

                // Verificar si ya se ha agregado una cita para este día
                if (!isset($proximasCitasPorDia[$fecha])) {
                    // Agregar esta cita como la próxima cita para este día
                    $proximasCitasPorDia[$fecha] = [
                        'hora' => $cita->hora,
                        'nombre' => $cita->nombre,
                        'fecha' => $fecha,
                    ];
                }
            }

            // Retornar el array con la próxima cita de cada día
            return response()->json($proximasCitasPorDia);
        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error al obtener la próxima cita: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error al obtener la próxima cita.'], 500);
        }
    }





    public function mostrarCitas(Request $request)
    {
        $fecha = $request->query('fecha');
        if (!$fecha) {
            return response()->json(['error' => 'Fecha no proporcionada'], 400);
        }

        // Obtener las citas paginadas ordenadas por hora ascendente
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $citas = Citas::whereDate('fecha', $fecha)
            ->orderBy('hora', 'asc')
            ->skip($offset)
            ->take($limit)
            ->get();

        $total = Citas::whereDate('fecha', $fecha)->count();


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
            // Validar los datos recibidos
            $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|string|size:10',
                'email' => 'nullable|email|max:255',
                'tipo_profesional' => 'required|in:Doctora,Nutrióloga',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'motivo' => 'required|string|max:255',
            ]);

            // Log detallado para verificar los valores recibidos
            Log::info("Valores recibidos: ", $request->all());

            // Verificar si ya existe una cita en la misma fecha y hora con el mismo tipo de profesional
            $existeCitaMismoProfesional = Citas::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->where('tipo_profesional', $request->tipo_profesional)
                ->exists();

            // Verificar si ya existen citas para ambos tipos de profesionales en la misma fecha y hora
            $existenAmbosProfesionales = Citas::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->distinct()
                ->count('tipo_profesional') == 2;

            // Log del resultado de la búsqueda
            Log::info("Existencia de cita con el mismo profesional: " . ($existeCitaMismoProfesional ? 'Sí' : 'No'));
            Log::info("Existencia de citas con ambos profesionales: " . ($existenAmbosProfesionales ? 'Sí' : 'No'));

            if ($existeCitaMismoProfesional || $existenAmbosProfesionales) {
                return response()->json(['status' => 'error', 'message' => 'Ya existe una cita en esa fecha y hora para el mismo tipo de profesional o ambos tipos están ocupados.'], 400);
            }

            // Crear nueva cita
            $cita = Citas::create([
                'nombre' => $request->input('nombre'),
                'telefono' => $request->input('telefono'),
                'email' => $request->input('email'),
                'tipo_profesional' => $request->input('tipo_profesional'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora'),
                'motivo' => $request->input('motivo'),

            ]);
            // Envío de correo electrónico
            if ($cita->email) {
                Mail::to($cita->email)->send(new ConsultaMail($cita));
            }

            return response()->json(['status' => 'success', 'message' => 'Cita guardada correctamente.'], 200);
        } catch (\Exception $e) {
            Log::error('Error al guardar la cita: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error al guardar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }

    public function validarHora($fecha, $hora)
    {
        $existe = Citas::where('fecha', $fecha)
            ->where('hora', $hora)
            ->exists();

        $existenAmbosProfesionales = Citas::where('fecha', $fecha)
            ->where('hora', $hora)
            ->distinct()
            ->count('tipo_profesional') == 2;

        return response()->json(['existe' => $existe, 'existenAmbosProfesionales' => $existenAmbosProfesionales]);
    }



    public function actualizar(Request $request, $id)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|string|size:10',
                'email' => 'nullable|email|max:255',
                'tipo_profesional' => 'required|in:Doctora,Nutrióloga',
                'fecha' => 'required|date',
                'hora' => 'required',
                'motivo' => 'required|string|max:255',
            ]);

            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);

            // Actualizar los datos de la cita
            $cita->update([
                'nombre' => $request->input('nombre'),
                'telefono' => $request->input('telefono'),
                'email' => $request->input('email'),
                'tipo_profesional' => $request->input('tipo_profesional'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora'),
                'motivo' => $request->input('motivo'),
            ]);
            // Enviar correo electrónico
            if ($request->input('email')) {
                Mail::to($request->input('email'))->send(new EditarConsultaMail($cita));
            }

            // Redireccionar con un mensaje de éxito
            return response()->json(['status' => 'success', 'message' => 'Cita actualizada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al actualizar la cita: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return response()->json(['status' => 'error', 'message' => 'Error al actualizar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }

    public function validarHoraModificar($id, $fecha, $hora, $tipo_profesional)
    {
        $existe = Citas::where('fecha', $fecha)
            ->where('hora', $hora)
            ->where('tipo_profesional', $tipo_profesional)
            ->where('id', '!=', $id)
            ->exists();

        return response()->json(['existe' => $existe]);
    }

    public function cancelar($id)
    {
        try {
            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);

            // Eliminar la cita
            $cita->delete();

            // Devolver una respuesta de éxito
            return response()->json(['status' => 'success', 'message' => 'Cita cancelada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al cancelar la cita: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['status' => 'error', 'message' => 'Error al cancelar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }
}
