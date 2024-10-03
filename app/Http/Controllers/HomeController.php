<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        Carbon::setLocale('es');

        $breadcrumbs = [
            ['name' => 'Inicio', '' => ''],

        ];

        $months = [];

        // Get months 
        for ($month = 1; $month <= 12; $month++) {
            $months[] = [
                'id' => $month,
                'month' => ucfirst(Carbon::create()->month($month)->translatedFormat('F'))
            ];
        }

        $months = collect($months);

        // Get years of today and last year
        $currentYear = Carbon::now()->year;
        $years = range($currentYear, $currentYear - 1);


        return view('home', compact('breadcrumbs', 'months', 'years'));
    }

    public function getDataStatistics()
    {

        try {
            // DB::enableQueryLog();



            $consultationDisease = Consulta::with(['consulta_has_enfermedad' => function ($query) {
                return $query
                        ->select('id_especifica_ahf', 'nombre')
                        ->orderBy('nombre', 'asc');
            }])
                ->select('id_consulta', 'id_persona')                
                ->get();

            $countMenAndWomen = Consulta::with('persona:id_persona,sexo')
                ->select('id_consulta', 'id_persona')
                ->get()
                ->groupBy('persona.sexo')->map(function ($item, $key) {
                    return ['sexo' => $key, 'count' => $item->count()];
                })->values();


            $countStudentAndAdministrative = Consulta::with(['persona' => function ($query) {
                return $query->whereNotNull('codigo')->select('id_persona', 'codigo');
            }])
                ->select('id_consulta', 'id_persona')
                ->get()
                ->groupBy('persona.codigo')->map(function ($item, $key) {
                    return ['codigo' => $key, 'count' => $item->count()];
                })->values();


            $countStudentAndAdministrativeData = $countStudentAndAdministrative->map(function ($item) {
                $group = '';
                if (strlen($item['codigo']) == 7) {
                    $group = 'Trabajador UDG';
                } else if (strlen($item['codigo']) == 9) {
                    $group = 'Estudiante';
                } else {
                    $group = 'Externo';
                }

                return [
                    'group' => $group,
                    'count' => $item['count']
                ];
            })->groupBy('group')->map(function ($item, $key) {
                return ['group' => $key, 'count' => $item->sum('count')];
            })->values();


            $consultationDiseaseData = $consultationDisease->flatMap(function ($item) {
                return $item->consulta_has_enfermedad;
            })->groupBy('nombre')->map(function ($item, $key) {
                return ['nombre' => $key, 'count' => $item->count()];
            })->values();




            // throw new \Exception('Error en la validación');
            // $query = DB::getQueryLog();

            // return response()->json([$query]);

            return response()->json([
                'countMenAndWomen' => $countMenAndWomen,
                'consultationDisease' => $consultationDiseaseData,
                'countStudentAndAdministrative' => $countStudentAndAdministrativeData,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Oops...!', 'msg' => 'Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getDataStatisticsDiseases($monthRequest, $yearRequest)
    {

        $month = $monthRequest ?? '';
        $year = $yearRequest ?? '';

        try {
            // DB::enableQueryLog();

            $consultationDisease = Consulta::with('consulta_has_enfermedad:id_especifica_ahf,nombre')
                ->select('id_consulta', 'id_persona', 'created_at')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $consultationDiseaseData = $consultationDisease->flatMap(function ($item) {
                return $item->consulta_has_enfermedad;
            })->groupBy('nombre')->map(function ($item, $key) {
                return ['nombre' => $key, 'count' => $item->count()];
            })->values();

            return response()->json([
                'consultationDisease' => $consultationDiseaseData,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Oops...!', 'msg' => 'Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    public function getDataStatisticsSex($monthRequest, $yearRequest)
    {

        $month = $monthRequest ?? '';
        $year =  $yearRequest ?? '';

        try {
            // DB::enableQueryLog();

            $countMenAndWomen = Consulta::with('persona:id_persona,sexo')
                ->select('id_consulta', 'id_persona', 'created_at')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get()
                ->groupBy('persona.sexo')->map(function ($item, $key) {
                    return ['sexo' => $key, 'count' => $item->count()];
                })->values();

            return response()->json([
                'countMenAndWomen' => $countMenAndWomen,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Oops...!', 'msg' => 'Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    public function getDataStatisticsTypePerson($monthRequest, $yearRequest)
    {
        $month = $monthRequest ?? '';
        $year = $yearRequest ?? '';

        try {
            // DB::enableQueryLog();

            $countStudentAndAdministrative = Consulta::with(['persona' => function ($query) {
                return $query->whereNotNull('codigo')->select('id_persona', 'codigo');
            }])
                ->select('id_consulta', 'id_persona', 'created_at')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get()
                ->groupBy('persona.codigo')->map(function ($item, $key) {
                    return ['codigo' => $key, 'count' => $item->count()];
                })->values();

            $countStudentAndAdministrativeData = $countStudentAndAdministrative->map(function ($item) {
                $group = '';
                if (strlen($item['codigo']) == 7) {
                    $group = 'Trabajador UDG';
                } else if (strlen($item['codigo']) == 9) {
                    $group = 'Estudiante';
                } else {
                    $group = 'Externo';
                }

                return [
                    'group' => $group,
                    'count' => $item['count']
                ];
            })->groupBy('group')->map(function ($item, $key) {
                return ['group' => $key, 'count' => $item->sum('count')];
            })->values();


            return response()->json([
                'countStudentAndAdministrative' => $countStudentAndAdministrativeData,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Oops...!', 'msg' => 'Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.', 'error' => $e->getMessage()], 500);
        }
    }
}
