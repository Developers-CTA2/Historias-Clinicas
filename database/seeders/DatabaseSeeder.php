<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Tipos_enfermedades;
use App\Models\Enfermedad_especifica;
use App\Models\Toxicomanias;
use App\Models\Alergia;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Tipo de AHF
        $Tipo_AHF = [
            ['id_tipo_ahf' => 1, 'nombre' => 'Dislipidemias','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 2, 'nombre' => 'Neurológicas','created_by'=> 1,'updated_by'=> 1], 
            ['id_tipo_ahf' => 3, 'nombre' => 'Neoplasias','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 4, 'nombre' => 'Cardiopatías','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 5, 'nombre' => 'Respiratorio','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 6, 'nombre' => 'Hepatopatías','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 7, 'nombre' => 'Nefropatías','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 8, 'nombre' => 'Endocrinológicas','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 9, 'nombre' => 'Reumatológicas','created_by'=> 1,'updated_by'=> 1],
        ]; 

        $Especificar_ahf = [
            ['id_tipo_ahf' => 1, 'nombre' => 'Hipercolesterolemia','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 1, 'nombre' => 'Hipertrigliceridemia','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 2, 'nombre' => 'Enfermedad de Parkinson','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 2, 'nombre' => 'Alzheimer','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 2, 'nombre' => 'Migraña','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 3, 'nombre' => 'Cáncer de mama','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 3, 'nombre' => 'Cáncer de pulmón','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 3, 'nombre' => 'Leucemia','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 3, 'nombre' => 'Linfoma','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 4, 'nombre' => 'Infarto de miocardio','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 4, 'nombre' => 'Hipertensión arterial','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 5, 'nombre' => 'Asma','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 5, 'nombre' => 'Neumonía','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 5, 'nombre' => 'Bronquitis crónica','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 6, 'nombre' => 'Hepatitis','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 6, 'nombre' => 'Cirrosis hepática','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 6, 'nombre' => 'Esteatosis hepática (hígado graso)','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 7, 'nombre' => 'Insuficiencia renal crónica','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 7, 'nombre' => 'Nefropatía diabética','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 8, 'nombre' => 'Diabetes mellitus','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 8, 'nombre' => 'Hipertiroidismo','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 8, 'nombre' => 'Síndrome de ovario poliquístico','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 9, 'nombre' => 'Artritis reumatoide','created_by'=> 1,'updated_by'=> 1],
            ['id_tipo_ahf' => 9, 'nombre' => 'Osteoartritis','created_by'=> 1,'updated_by'=> 1],
        ];

        //Tipo de Toxicomanias
        $Toxicomanias = [
            ['id' => 1, 'nombre' => 'Tabaquismo','created_by'=> 1,'updated_by'=> 1], 
            ['id' => 2, 'nombre' => 'Alcoholismo','created_by'=> 1,'updated_by'=> 1],
            // ['id' => 4, 'nombre' => 'Adicción a opiáceos'],
            // ['id' => 5, 'nombre' => 'Adicción a estimulantes'], 
            // ['id' => 6, 'nombre' => 'Adicción a cannabis'],
            // ['id' => 7, 'nombre' => 'Adicción a alucinógenos'], 
            // ['id' => 8, 'nombre' => 'Adicción a Inhalantes'], 
            // ['id' => 9, 'nombre' => 'Adicción a Drogas de Diseño'], 
            ['id' => 3, 'nombre' => 'Otras','created_by'=> 1,'updated_by'=> 1]
        ];

        //Tipo de Alergias
        // $Alergias = [
        //     ['id_alergia' => 1, 'nombre' => 'Piel'],
        //     ['id_alergia' => 2, 'nombre' => 'Respiratorias'], 
        //     ['id_alergia' => 3, 'nombre' => 'Alimenticias'], 
        // ];

        $Alergias = [
            ['id_alergia' => 1, 'nombre' => 'Alergias alimentarias','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 2, 'nombre' => 'Alergias respiratorias','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 3, 'nombre' => 'Alergias cutáneas','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 4, 'nombre' => 'Alergias Medicamentos','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 5, 'nombre' => 'Alergias a picaduras de insectos','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 6, 'nombre' => 'Alergias a animales','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 7, 'nombre' => 'Alergias al látex','created_by'=> 1,'updated_by'=> 1],
            ['id_alergia' => 8, 'nombre' => 'Alergias oculares','created_by'=> 1,'updated_by'=> 1],
        ];
    
    
        User::create([
            'name' => 'Alecs',
            'user_name' => '286579',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('1234'),
        ])->assignRole(2);

        User::create([
            'name' => 'LOMELI ZERMEÑO JAZMIN',
            'user_name' => '2166104',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(2);

        User::create([
            'name' => 'CTA',
            'user_name' => '010101',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(1);

        User::create([
            'name' => 'SOLANO GUZMÁN EDUARDO',
            'user_name' => '2921073',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'cedula' => '12771247',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(1);

        User::create([
            'name' => 'GONZALEZ RAMIREZ JOSELIN',
            'user_name' => '2175917',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(2);


        User::create([
            'name' => 'GONZÁLEZ CERVANTES JUAN LUIS',
            'user_name' => '2726319',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(3);

        User::create([
            'name' => 'DOMINGUEZ PADILLA JUAN PEDRO',
            'user_name' => '2168827',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(1);

        User::create([
            'name' => 'GÓMEZ FRANCO LUIS FRANCISCO',
            'user_name' => '2965531',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(3);

        User::create([
            'name' => 'DE ANDA GARCÍA LLIN LU GUADALUPE',
            'user_name' => '2725819',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(3);

        User::create([
            'name' => 'RAMÍREZ RODRÍGUEZ VIRGINIA',
            'user_name' => '9205195',
            'estado' => 'Activo',
            'email' => 'ejemplo@gmail.com',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(2);
        


        Tipos_enfermedades::insert($Tipo_AHF);
        Toxicomanias::insert($Toxicomanias);
        Alergia::insert($Alergias);
        Enfermedad_especifica::insert($Especificar_ahf);
    }
  
}
