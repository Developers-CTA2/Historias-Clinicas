<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use App\Mail\ConsultaMail;
use App\Mail\EditarConsultaMail;
use Carbon\Carbon;

use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


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
                // Verificar que la cita esté en estado pendiente
                if ($cita->estado !== 'Pendiente') {
                    continue; // Saltar esta cita si no está pendiente
                }

                // Asegurarse de que la fecha sea un objeto Carbon
                $fecha = \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d');

                // Verificar si ya se ha agregado una cita para este día
                if (!isset($proximasCitasPorDia[$fecha])) {
                    // Agregar esta cita como la próxima cita para este día, incluyendo tipo_profesional
                    $proximasCitasPorDia[$fecha] = [
                        'hora' => $cita->hora,
                        'nombre' => $cita->nombre,
                        'fecha' => $fecha,
                        'tipo_profesional' => $cita->tipo_profesional, // Asegúrate de tener esto en tu modelo Citas
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

        $carbonDate = Carbon::parse($fecha);
        if ($carbonDate->isWeekend()) {
            return response()->json(['error' => 'No se puede seleccionar sábados o domingos'], 400);
        }

        // Obtener las citas de la doctora y de la nutrióloga por separado
        $citasDoctora = Citas::whereDate('fecha', $fecha)
            ->where('tipo_profesional', 'Doctora')
            ->orderBy('hora', 'asc')
            ->get();

        $citasNutriologa = Citas::whereDate('fecha', $fecha)
            ->where('tipo_profesional', 'Nutrióloga')
            ->orderBy('hora', 'asc')
            ->get();

        // Combinar las citas si es necesario para mostrar en una sola vista
        $citas = $citasDoctora->merge($citasNutriologa);

        $breadcrumbs = [
            ['name' => 'Agenda', 'url' => route('showAgenda')],
            ['name' => 'Citas', '' => ''],
        ];

        $fechaFormateada = Carbon::parse($fecha)->locale('es')->isoFormat('LL');

        // return response()->json([
        //     'data' => $citas
        // ]);

        return view('admin.citas', [
            'fecha' => $fecha,
            'citasDoctora' => $citasDoctora,
            'citasNutriologa' => $citasNutriologa,
            'citas' => $citas,
        ], compact('breadcrumbs', 'fechaFormateada', 'citasDoctora', 'citasNutriologa', 'citas'));
    }


    // Get Citas for a specific date and professional type
    public function getCitas(Request $request)
    {

        try {

            $fecha = $request->input('fecha', Carbon::now()->format('Y-m-d'));
            $tipo_profesional = $request->input('tipo', 1);
            $search = $request->input('search', '');


            $tipo_profesionalDB = $tipo_profesional == 1 ? 'Doctora' : 'Nutrióloga';
            

            $citas = Citas::where('fecha', $fecha)
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

            if($citas->isEmpty()){
                return response()->json(['data' => [],'count' => 0]);
            }
                
            return response()->json(['data' => $citas ,'count' => $count]);

        } catch (\Exception $e) {
            Log::error('Error al obtener las citas: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las citas'], 500);
        }
    }

    public function getCitasPersona($id){

        try{

            $cita = Citas::findOrfail($id);
            $cita->hora = Carbon::parse($cita->hora)->format('H:i');
            return response()->json($cita);


        }catch(\Exception $e){
            Log::error('Error al obtener las citas de la persona: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener la cita seleccionada de la persona'], 500);
        }


    }

    public function guardarCita(StoreCitaRequest $request)
    {

        try {
            // Validar los datos recibidos

            $request->validated();

            // Verificar si existe una cita activa (no cancelada) en la misma fecha, hora y tipo de profesional

            // throw new \Exception('Error al guardar la cita');

            $citaActivaExistente = Citas::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->where('tipo_profesional', $request->tipo_profesional)
                ->where('estado', '<>', 'Cancelada') // <> significa diferente de 'Cancelada'
                ->exists();

            if ($citaActivaExistente) {
                return response()->json(['status' => 'error', 'message' => 'Ya existe una cita activa en esa fecha y hora para el mismo tipo de profesional.'], 400);
            }

            // Crear nueva cita
            $cita = Citas::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'email' => $request->correo,
                'tipo_profesional' => $request->tipo_profesional,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'motivo' => $request->motivo,
                'estado' => 'Pendiente',
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

    public function validarHora($fecha, $hora)
    {
        try {
            // Verificar si existe una cita activa (no cancelada) en la misma fecha y hora
            $existeActiva = Citas::where('fecha', $fecha)
                ->where('hora', $hora)
                ->where('estado', '<>', 'Cancelada')
                ->exists();

            // Verificar si existe una cita cancelada en la misma fecha y hora
            $existeCancelada = Citas::where('fecha', $fecha)
                ->where('hora', $hora)
                ->where('estado', 'Cancelada')
                ->exists();

            // Determinar si se puede reservar la hora o no
            $puedeReservar = !$existeActiva || $existeCancelada;

            return response()->json([
                'existe' => $existeActiva,
                'existeCancelada' => $existeCancelada,
                'puedeReservar' => $puedeReservar,
            ]);
        } catch (\Exception $e) {
            Log::error('Error al validar la hora: ' . $e->getMessage());
            return response()->json(['error' => 'Error al validar la hora'], 500);
        }
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
                'estado' => 'required',
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
                'estado' => $request->input('estado'),
            ]);

            // Enviar correo electrónico si se proporciona email
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

    public function validarHoraModificar($id, $fecha, $hora)
    {
        try {
            // Verificar si existe una cita activa (no cancelada) en la misma fecha y hora, excluyendo la cita actual
            $existe = Citas::where('fecha', $fecha)
                ->where('hora', $hora)
                ->where('id', '<>', $id)
                ->where('estado', '<>', 'Cancelada') // Estado diferente de 'Cancelada'
                ->exists();

            return response()->json(['existe' => $existe]);
        } catch (\Exception $e) {
            Log::error('Error al validar la hora: ' . $e->getMessage());
            return response()->json(['error' => 'Error al validar la hora'], 500);
        }
    }

    public function cancelar($id)
    {
        try {
            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);

            // Cambiar el estado de la cita a Cancelada
            $cita->estado = 'Cancelada';
            $cita->save();

            // Devolver una respuesta de éxito
            return response()->json(['status' => 'success', 'message' => 'Cita cancelada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al cancelar la cita: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['status' => 'error', 'message' => 'Error al cancelar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }

    public function eliminar($id)
    {
        try {
            // Buscar la cita por su ID
            $cita = Citas::findOrFail($id);

            // Eliminar la cita
            $cita->delete();

            // Devolver una respuesta de éxito
            return response()->json(['status' => 'success', 'message' => 'Cita eliminada correctamente.']);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error al cancelar la cita: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['status' => 'error', 'message' => 'Error al eliminar la cita. Por favor, inténtalo de nuevo.'], 500);
        }
    }
}
