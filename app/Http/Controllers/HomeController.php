<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\ConsultaHasEnfermedad;


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
        $breadcrumbs = [
            ['name' => 'Home', '' => ''],

        ];

        return view('home', compact('breadcrumbs'));
    }

    public function getDataStatistics()
    {

        try {

            $consultationDisease = Consulta::with('consulta_has_enfermedad:id_especifica_ahf,nombre')
                ->select('id_consulta', 'id_persona')
                ->get();

            $countMenAndWomen = Consulta::with('persona:id_persona,sexo')
                ->select('id_consulta', 'id_persona')
                ->get()
                ->groupBy('persona.sexo')->map(function ($item, $key) {
                    return ['sexo' => $key, 'count' => $item->count()];
                })->values();
                

            $countStudentAndAdministrative = Consulta::with(['persona' => function ($query) {
                return $query->whereNotNull('codigo')->select('id_persona','codigo');
            }])
                ->select('id_consulta', 'id_persona')
                ->get();

            $consultationDiseaseData = $consultationDisease->flatMap(function ($item) {
                $query = $item->consulta_has_enfermedad->groupBy('nombre')->map(function ($item, $key) {
                    return ['enfermedad' => $key, 'count' => $item->count()];
                })->values();

                return $query;
                
            });

            $countStudentAndAdministrative = $countStudentAndAdministrative->groupBy('persona.codigo')->flatMap(function ($item, $key) {
                if( strlen($key) == 9){
                    $key = 'Estudiante';
                }else if(strlen($key) == 7){
                    $key = 'Trabajador';
                }else{
                    $key = 'Otros';
                }

                return [
                    'tipo' => $key,
                    'count' => $item->count()
                ];
            });

            return response()->json([
                'countMenAndWomen' => $countMenAndWomen,
                'consultationDisease' => $consultationDiseaseData,
                'countStudentAndAdministrative' => $countStudentAndAdministrative
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['title' => 'Oops...', 'msg' => 'Ha sucedido un error inesperado al obtener los datos para las gráficas', 'error' => $e->getMessage()], 500);
        }
    }
}
