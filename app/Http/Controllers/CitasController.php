<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use Carbon\Carbon;

use App\Models\Citas;
use App\Models\EstatusCita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CitasController extends Controller
{
    public function agenda()
    {
        $breadcrumbs = [
            ['name' => 'Agenda', 'url' => route('showAgenda')],
        ];

        return view('admin.agenda', compact('breadcrumbs'));
    }

    public function proximaCita()
    {
        try {
            // Obtener la fecha y hora actuales
            $now = Carbon::now();

            // Obtener todas las citas desde la fecha y hora actuales ordenadas por fecha y hora ascendentes
            $todasLasCitas = Citas::with(['estatusCita'])
                ->whereHas('estatusCita', function ($query) {
                    $query->where('status', 'Pendiente');
                })
                ->where('fecha', '>=', $now->format('Y-m-d'))
                ->where(function($query) use ($now){
                    $query->where('fecha', '>', $now->format('Y-m-d'))
                    ->orWhere('hora', '>=', $now->format('H:i'));
                })
                // ->selectRaw('fecha, COUNT(*) as total_citas')
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->get()
                ->groupBy('fecha');

                $proximasCitasPorDia = $todasLasCitas->map(function($query){
                    return [
                        'fecha' => $query->first()->fecha,
                        'cantidad' => $query->count()
                    ];
                })->values();            

            // return response()->json([$citasAgrupadas,$now]);
        
    
            // Retornar el array con la próxima cita de cada día
            return response()->json($proximasCitasPorDia);
        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error al obtener la próxima cita: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error al obtener la próxima cita.'], 500);
        }
    }

    public function mostrarCitas(Request $request, $fecha)
    {
        // $fechaValor = $fecha;

        if (!$fecha) {
            return response()->json(['error' => 'Fecha no proporcionada'], 400);
        }

        $carbonDate = Carbon::parse($fecha);
        if ($carbonDate->isWeekend()) {
            return response()->json(['error' => 'No se puede seleccionar sábados o domingos'], 400);
        }

        $breadcrumbs = [
            ['name' => 'Agenda', 'url' => route('showAgenda')],
            ['name' => 'Citas', '' => ''],
        ];

        // Get all estatus for citas
        $estatus = EstatusCita::all();

        $fechaFormateada = Carbon::parse($fecha)->locale('es')->isoFormat('LL');

        return view('admin.citas', compact('breadcrumbs', 'fechaFormateada', 'fecha', 'estatus'));
    }


    // Get Citas for a specific date and professional type
    public function getCitas(Request $request, $fecha)
    {

        try {

            if(!$fecha){
                return response()->json(['error' => 'Fecha no proporcionada'], 400);
            }

            $tipo_profesional = $request->input('tipo', 1);
            $search = $request->input('search', '');


            $tipo_profesionalDB = $tipo_profesional == 1 ? 'Doctora' : 'Nutrióloga';



            $citas = Citas::with(['estatusCita'])
                ->whereHas('estatusCita', function ($query) {
                    $query->whereNot('status', 'Atendida');
                })
                ->where('fecha', $fecha)
                ->where('tipo_profesional', $tipo_profesionalDB)
                ->orderBy('hora', 'asc');

            $count  = $citas->count();

            if (!empty($search)) {
                $citas->where(function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('telefono', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('motivo', 'like', '%' . $search . '%');
                });
            }

            $citas = $citas->get();

            if ($citas->isEmpty()) {
                return response()->json(['data' => [], 'count' => 0]);
            }

            return response()->json(['data' => $citas, 'count' => $count]);
            
        } catch (\Exception $e) {
            Log::error('Error al obtener las citas: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las citas'], 500);
        }
    }

    public function getCitasPersona($id)
    {

        try {

            $cita = Citas::with(['estatusCita'])->findOrfail($id);
            $cita->hora = Carbon::parse($cita->hora)->format('H:i');

            return response()->json($cita);
        } catch (\Exception $e) {
            Log::error('Error al obtener las citas de la persona: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener la cita seleccionada de la persona'], 500);
        }
    }

    public function guardarCita(StoreCitaRequest $request)
    {

        try {
            // Validar los datos recibidos
            $request->validated();
            $currentDate = Carbon::now()->format('Y-m-d');

            if ($request->fecha < $currentDate) {
                return response()->json(['status' => 'error', 'message' => 'No se pueden agendar citas en fechas anteriores a la actual.'], 400);
            }

            if ($request->fecha == $currentDate && $request->hora < Carbon::now()->format('H:i')) {
                return response()->json(['status' => 'error', 'message' => 'No se pueden agendar citas en horas anteriores a la actual.'], 400);
            }


            $citaActivaExistente = Citas::with(['estatusCita'])
                ->whereHas('estatusCita', function ($query) {
                    $query->whereNot('status', 'Cancelada');
                })
                ->where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->where('tipo_profesional', $request->tipo_profesional)
                ->exists();

            if ($citaActivaExistente) {
                return response()->json(['status' => 'error', 'message' => 'Ya existe una cita activa en esa fecha y hora para el mismo tipo de profesional.'], 400);
            }

            $initialStatus = EstatusCita::where('status', 'Pendiente')->first();

            // Crear nueva cita
            $cita = Citas::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'email' => $request->correo,
                'tipo_profesional' => $request->tipo_profesional,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'motivo' => $request->motivo,
                'estatus_cita_id' => $initialStatus->id,
            ]);

            // Envío de correo electrónico
            if ($cita->email) {
                // Mail::to($cita->email)->send(new ConsultaMail($cita));
            }

            return response()->json(['title' => 'Éxito...', 'message' => 'Cita guardada correctamente.'], 200);
        } catch (\Exception $e) {
            Log::error('Error al guardar la cita: ' . $e->getMessage());
            return response()->json(['title' => 'Oops..!', 'message' => 'Error al guardar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }


    public function update(UpdateCitaRequest $request, $id)
    {
        try {

            $request->validated();
            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);


            // Actualizar los datos de la cita
            $cita->update([
                'nombre' => $request->input('nameEdit'),
                'telefono' => $request->input('phoneEdit'),
                'email' => $request->input('emailEdit'),
                'tipo_profesional' => $request->input('typeProfessionalEdit'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hourEdit'),
                'motivo' => $request->input('reasonEdit'),
                'estatus_cita_id' => $request->input('statusEdit')
            ]);

            // // Enviar correo electrónico si se proporciona email
            // if ($request->input('email')) {
            //     Mail::to($request->input('email'))->send(new EditarConsultaMail($cita));
            // }

            // Redireccionar con un mensaje de éxito
            return response()->json(['status' => 'success', 'title' => 'Éxito...', 'message' => 'Cita actualizada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al actualizar la cita: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return response()->json(['status' => 'error', 'message' => 'Error al actualizar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }


    // public function cancelar($id)
    // {
    //     try {
    //         // Buscar la cita por su ID
    //         $cita = Citas::findOrFail($id);

    //         // Cambiar el estado de la cita a Cancelada
    //         $cita->estado = 'Cancelada';
    //         $cita->save();

    //         // Devolver una respuesta de éxito
    //         return response()->json(['status' => 'success', 'message' => 'Cita cancelada correctamente.']);
    //     } catch (\Exception $e) {
    //         // Log del error
    //         Log::error('Error al cancelar la cita: ' . $e->getMessage());

    //         // Devolver una respuesta de error
    //         return response()->json(['status' => 'error', 'message' => 'Error al cancelar la cita. Por favor, inténtalo de nuevo.'], 500);
    //     }
    // }

    public function delete($id)
    {
        try {
            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);

            // Eliminar la cita
            $cita->delete();

            // Devolver una respuesta de éxito
            return response()->json(['status' => 'success', 'title' => 'Éxito...',  'message' => 'Cita eliminada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al cancelar la cita: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['status' => 'error', 'message' => 'Error al eliminar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }

    public function testCitas()
    {
        $citas = Citas::with(['estatusCita'])
            ->whereHas('estatusCita', function ($query) {
                $query->whereNot('status', 'Cancelada');
            })
            ->where('fecha', '2024-09-27')
            ->where('hora', '09:00')
            ->where('tipo_profesional', 'Doctora')
            ->get();
        return response()->json($citas);
    }
}
