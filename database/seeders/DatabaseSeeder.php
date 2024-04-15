<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'LOMELI ZERMEÑO JAZMIN',
            'user_name' => '216610402',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(1);
    }
}
