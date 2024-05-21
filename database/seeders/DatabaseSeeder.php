<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Tipo_ahf;
use App\Models\Especificar_ahf;
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
            ['id_tipo_ahf' => 1, 'nombre' => 'Dislipidemias'],
            ['id_tipo_ahf' => 2, 'nombre' => 'Neurológicas'], 
            ['id_tipo_ahf' => 3, 'nombre' => 'Neoplasias'],
            ['id_tipo_ahf' => 4, 'nombre' => 'Cardiopatías'],
            ['id_tipo_ahf' => 5, 'nombre' => 'Respiratorio'],
            ['id_tipo_ahf' => 6, 'nombre' => 'Hepatopatías'],
            ['id_tipo_ahf' => 7, 'nombre' => 'Nefropatías'],
            ['id_tipo_ahf' => 8, 'nombre' => 'Endocrinológicas'],
            ['id_tipo_ahf' => 9, 'nombre' => 'Reumatológicas'],
        ]; 

        $Especificar_ahf = [
            ['id_tipo_ahf' => 1, 'nombre' => 'Hipercolesterolemia'],
            ['id_tipo_ahf' => 1, 'nombre' => 'Hipertrigliceridemia'],
            ['id_tipo_ahf' => 2, 'nombre' => 'Enfermedad de Parkinson'],
            ['id_tipo_ahf' => 2, 'nombre' => 'Alzheimer'],
            ['id_tipo_ahf' => 2, 'nombre' => 'Migraña'],
            ['id_tipo_ahf' => 3, 'nombre' => 'Cáncer de mama'],
            ['id_tipo_ahf' => 3, 'nombre' => 'Cáncer de pulmón'],
            ['id_tipo_ahf' => 3, 'nombre' => 'Leucemia'],
            ['id_tipo_ahf' => 3, 'nombre' => 'Linfoma'],
            ['id_tipo_ahf' => 4, 'nombre' => 'Infarto de miocardio'],
            ['id_tipo_ahf' => 4, 'nombre' => 'Hipertensión arterial'],
            ['id_tipo_ahf' => 5, 'nombre' => 'Asma'],
            ['id_tipo_ahf' => 5, 'nombre' => 'Neumonía'],
            ['id_tipo_ahf' => 5, 'nombre' => 'Bronquitis crónica'],
            ['id_tipo_ahf' => 6, 'nombre' => 'Hepatitis'],
            ['id_tipo_ahf' => 6, 'nombre' => 'Cirrosis hepática'],
            ['id_tipo_ahf' => 6, 'nombre' => 'Esteatosis hepática (hígado graso)'],
            ['id_tipo_ahf' => 7, 'nombre' => 'Insuficiencia renal crónica'],
            ['id_tipo_ahf' => 7, 'nombre' => 'Nefropatía diabética'],
            ['id_tipo_ahf' => 8, 'nombre' => 'Diabetes mellitus'],
            ['id_tipo_ahf' => 8, 'nombre' => 'Hipertiroidismo'],
            ['id_tipo_ahf' => 8, 'nombre' => 'Síndrome de ovario poliquístico'],
            ['id_tipo_ahf' => 9, 'nombre' => 'Artritis reumatoide'],
            ['id_tipo_ahf' => 9, 'nombre' => 'Osteoartritis'],
        ];

        //Tipo de Toxicomanias
        $Toxicomanias = [
            ['id' => 1, 'nombre' => 'Tabaquismo'],
            ['id' => 2, 'nombre' => 'Alcoholismo'], 
        ];

        //Tipo de Alergias
        $Alergias = [
            ['id_alergia' => 1, 'nombre' => 'Piel'],
            ['id_alergia' => 2, 'nombre' => 'Respiratorias'], 
            ['id_alergia' => 3, 'nombre' => 'Alimenticias'], 
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

       

        Tipo_ahf::insert($Tipo_AHF);
        Toxicomanias::insert($Toxicomanias);
        Alergia::insert($Alergias);
        Especificar_ahf::insert($Especificar_ahf);
    }
  
}
