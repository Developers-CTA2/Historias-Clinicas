<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Domicilio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ExpedientController extends Controller
{
    public function Patient_details($id)
    {
        $Personal = Persona::with([
            'domicilio',
            'persona_enfermedades.enfermedad_especifica',
            'toxicomanias_persona.toxicomanias',
            'nutricional',
            'persona_ahf.especificar_ahf',
            'Persona_alergia.alergias',
            'transfusiones',
            'hospitalizaciones',
            'traumatismos',
            'ant_quirurgicos',
            'gyo',
        ])->find($id);

        if (!$Personal) {

            $breadcrumbs = [
                ['name' => 'Pacientes', '' => ''],
            ];

            return view('patients.seePatient', compact('breadcrumbs'));
        }


        $domicilio = $Personal->domicilio;
        $enfermedades = $Personal->persona_enfermedades;
        $toxicomanias = $Personal->toxicomanias_persona;
        $ahf = $Personal->persona_ahf;
        $alergias = $Personal->Persona_alergia;
        $transfusiones = $Personal->transfusiones;
        $hospitalizaciones = $Personal->hospitalizaciones;
        $traumatismos = $Personal->traumatismos;
        $quirurgicos = $Personal->ant_quirurgicos;
        $gyo = $Personal->gyo;

        // return response()->json($domicilio);
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' =>  route('patients.patients')],
            ['name' => 'Expediente', '' => ''],

        ];
        return view('patients.expediente', compact('breadcrumbs',  'Personal', 'domicilio', 'enfermedades', 'toxicomanias', 'ahf', 'alergias', 'transfusiones', 'hospitalizaciones', 'quirurgicos', 'traumatismos', 'gyo'));
    }


    public function Update_Personal_Data(Request $request)
    {
        $data = $request->validate([
            'Type' => 'required|numeric',
            'Id_dom' => 'required|numeric',
            'Id' => 'required|numeric|exists:personas,id_persona',
            'Direction.country' => 'required|string',
            'Direction.state' => 'required|string',
            'Direction.city' => 'required|string',
            'Direction.colony' => 'required|string',
            'Direction.cp' => 'required|numeric',
            'Direction.street' => 'required|string',
            'Direction.ext' => 'required|numeric',
            'Direction.int' => 'nullable|string',
            'Personal.name' => 'required|string',
            'Personal.tel' => 'required|string',
            'Personal.gender' => 'required|string',
            'Personal.birthday' => 'required|date',
            'Personal.religion' => 'required|string',
            'Personal.ocupation' => 'required|string',
            'Personal.nss' => 'required|numeric',
            'Personal.name_e' => 'required|string',
            'Personal.tel_e' => 'required|string',
            'Personal.parent_e' => 'required|string',
        ]);

        $name = $data['Personal']['name'];
        $tel = $data['Personal']['tel'];
        $birthday = $data['Personal']['birthday'];
        $gender = $data['Personal']['gender'];
        $religion = $data['Personal']['religion'];
        $ocupation = $data['Personal']['ocupation'];
        $nss = $data['Personal']['nss'];
        $name_e = $data['Personal']['name_e'];
        $tel_e = $data['Personal']['tel_e'];
        $parent_e = $data['Personal']['parent_e'];

        $country = $data['Direction']['country'];
        $state = $data['Direction']['state'];
        $city = $data['Direction']['city'];
        $cp = $data['Direction']['cp'];
        $colony = $data['Direction']['colony'];
        $num_int = $data['Direction']['int'];
        $ext = $data['Direction']['ext'];
        $street = $data['Direction']['street'];
        $Id = $data['Id'];

        //  return response()->json($data);

        switch ($data['Type']) {
            case 1: {  // Solo cambiaron los datos personales 
                    $Personal = Persona::where('id_persona', $data['Id'])->first();

                    DB::transaction(function () use ($name, $tel, $birthday, $gender, $religion, $ocupation, $nss, $name_e, $tel_e, $parent_e, $Personal) {
                        $Personal->update([
                            'nombre' => $name,
                            'ocupacion' => $ocupation,
                            'fecha_nacimiento' => $birthday,
                            'sexo' => $gender,
                            'telefono' => $tel,
                            'telefono_emerge' => $tel_e,
                            'contacto_emerge' => $name_e,
                            'parentesco_emerge' => $parent_e,
                            'nss' => $nss,
                            'religion' => $religion,
                            'updated_by' => Auth::id()
                        ]);
                    });
                    return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                }
            case 2: {    // Solo cambiaron los datos del domicilio
                    $Domicilio = Domicilio::where('id_domicilio', $data['Id_dom'])->first();

                    if ($Domicilio) {
                        DB::transaction(function () use ($country, $state, $city, $cp, $colony, $num_int, $ext, $street, $Domicilio, $data) {
                            $Domicilio->update([
                                'ciudad_municipio' => $city,
                                'estado' => $state,
                                'pais' => $country,
                                'calle' => $street,
                                'num' => $ext,
                                'num_int' => $num_int,
                                'colonia' => $colony,
                                'cp' => $cp,
                                'updated_by' => Auth::id()

                            ]);
                        });
                        return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                    } else {
                        return response()->json(['msg' => 'Error al actualizar los datos.'], 404);
                    }
                }
            case 3: {   // Cambiaron los datos del domicilio y personales
                    $Personal = Persona::where('id_persona', $data['Id'])->first();
                    $Domicilio = Domicilio::where('id_domicilio', $data['Id_dom'])->first();

                    DB::transaction(function () use ($name, $tel, $birthday, $gender, $religion, $ocupation, $nss, $name_e, $tel_e, $parent_e, $country, $street, $ext, $num_int, $colony, $cp, $city, $state, $Personal, $Domicilio) {
                        $Personal->update([
                            'nombre' => $name,
                            'ocupacion' => $ocupation,
                            'fecha_nacimiento' => $birthday,
                            'sexo' => $gender,
                            'telefono' => $tel,
                            'telefono_emerge' => $tel_e,
                            'contacto_emerge' => $name_e,
                            'parentesco_emerge' => $parent_e,
                            'nss' => $nss,
                            'religion' => $religion,
                            'updated_by' => Auth::id()

                        ]);

                        $Domicilio->update([
                            'ciudad_municipio' => $city,
                            'estado' => $state,
                            'pais' => $country,
                            'calle' => $street,
                            'num' => $ext,
                            'num_int' => $num_int,
                            'colonia' => $colony,
                            'cp' => $cp,
                            'updated_by' => Auth::id()

                        ]);
                    });
                    return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                }
        }
        return response()->json(['status' => 404, 'msg' => 'Error al actualizar los datos']);
    }
}