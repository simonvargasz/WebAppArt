<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('imagenes')->insert([
            [
                'id' => 1,
                'titulo' => '1.jpg',
                'archivo' => '1.jpg',
                'baneada' => 0,
                'motivo_ban' => '',
                'cuenta_user' => 'artista1',
            ],
            [
                'id' => 2,
                'titulo' => '2.png',
                'archivo' => '2.png',
                'baneada' => 0,
                'motivo_ban' => '',
                'cuenta_user' => 'artista1',
            ],
            [
                'id' => 3,
                'titulo' => '3.png',
                'archivo' => '3.png',
                'baneada' => 0,
                'motivo_ban' => '',
                'cuenta_user' => 'artista1',
            ],
            [
                'id' => 4,
                'titulo' => '4.png',
                'archivo' => '4.png',
                'baneada' => 0,
                'motivo_ban' => '',
                'cuenta_user' => 'artista1',
            ],
            [
                'id' => 5,
                'titulo' => '5.png',
                'archivo' => '5.png',
                'baneada' => 0,
                'motivo_ban' => '',
                'cuenta_user' => 'artista1',
            ]

        ]);
    }
}
