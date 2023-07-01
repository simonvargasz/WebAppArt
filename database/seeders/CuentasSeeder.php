<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuentas')->insert([
            [
                'user' => 'admin1',
                'password' => Hash::make('admin123'),
                'nombre' => 'John',
                'apellido' => 'Doe',
                'perfil_id' => 1,
            ],
            [
                'user' => 'artista1',
                'password' => Hash::make('artista123'),
                'nombre' => 'Simon',
                'apellido' => 'Vargas',
                'perfil_id' => 2,
            ],
            [
                'user' => 'artista2',
                'password' => Hash::make('artista123'),
                'nombre' => 'Pepito',
                'apellido' => 'Sugoma',
                'perfil_id' => 2,
            ],
        ]);
    }
}
