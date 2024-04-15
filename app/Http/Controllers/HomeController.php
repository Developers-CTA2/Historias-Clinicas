<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Personas_trabajo;
use App\Models\User;

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
        return view('home');
    }

    public function counts()
    {
        $Totales = Administrativo::whereNot('estado_id', 5)->count() ?? 0;

        $Administrativos = Personas_trabajo::where('nombramiento', 1)->whereNot('id_estado', 5)
            ->count() ?? 0;

        $Operativos = Personas_trabajo::where('nombramiento', 2)->whereNot('id_estado', 5)
            ->count() ?? 0;

        $Directivos = Personas_trabajo::where('nombramiento', 3)->whereNot('id_estado', 5)
            ->count() ?? 0;

        $PTC = Personas_trabajo::where('nombramiento', 4)->whereNot('id_estado', 5)
            ->count() ?? 0;


        $TA = Personas_trabajo::where('nombramiento', 5)->whereNot('id_estado', 5)
            ->count() ?? 0;

        $PA = Personas_trabajo::where('nombramiento', 6)->whereNot('id_estado', 5)
            ->count() ?? 0;

        $User = User::count() ?? 0;

        $Data[] = [
            'Totales' =>  $Totales,
            'Admin' =>  $Administrativos,
            'Operativos' =>  $Operativos,
            'Directivos' =>  $Directivos,
            'PTC' =>  $PTC,
            'TA' => $TA,
            'PA' =>  $PA,
            'Users' =>  $User
        ];


        //$Totales = Administrativo::with('estado');

        // $Totales = Administrativo::where('estado', 'activo')->count();
        //$Totales = Administrativo::find(2)->estado();
        return response()->json(['status' => 200, 'Counts' => $Data]);
    }


    public function CountDetailsPeople(Request $request)
    {

        $data = $request->validate([
            'caso' => 'required|numeric',
        ]);

        $Results = [];
        $Left = [];
        $opcion  = $data['caso'];
        switch ($opcion) {
            case 1: {
                    //Todos
                    $T_AC = Administrativo::whereNot('estado_id', 5)->count() ?? 0;
                    $Male = Administrativo::whereNot('estado_id', 5)->where('sexo', 'Masculino')->count() ?? 0;
                    $Female = Administrativo::whereNot('estado_id', 5)->where('sexo', 'Femenino')->count() ?? 0;
                    //Incapacidad
                    $Incap= Administrativo::whereNot('estado_id', 5)->count() ?? 0;

                    $Left=[
                        'Busqueda' => "Busqueda de personal",
                        'Tilte_Principal' => "Personal total",
                        'Total' => $T_AC,
                        'Male' =>  $Male,
                        'Female' =>  $Female,
                    ];

                    $Results = [
                        
                        'Tilte_left' => "Personal activos",
                        'Total' => $T_AC,
                        
                    ];

                    break;
                }
            case 2: {
                    $Results = [
                        'Busqueda' => "Busqueda de Administrativos",
                        'Tilte_Principal' => "Personal Administrativo",
                        'Tilte_left' => "Administrativos activos",
                    ];

                    break;
                }
            case 3: {
                    $Results = "Busqueda de operativos";
                }
        }


       



        return response()->json(['status' => 200, 'Left' => $Left, 'A' => $Results]);
    }
}
