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
            'name' => 'Alecs',
            'user_name' => '286579',
            'password' => Hash::make('1234'),
        ])->assignRole(1);
    }
}
