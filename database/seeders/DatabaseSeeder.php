<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Tipo_ahf;
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
            'password' => Hash::make('1234'),
        ])->assignRole(1);

        User::create([
            'name' => 'LOMELI ZERMEÑO JAZMIN',
            'user_name' => '216610402',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(1);

        Tipo_ahf::insert($Tipo_AHF);
        Toxicomanias::insert($Toxicomanias);
        Alergia::insert($Alergias);
    }
  
}
