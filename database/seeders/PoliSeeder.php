<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polis = [
            [
                'nama' => 'Gigi',
                'deskripsi' => 'lorem ipsum',
            ],            
            [
                'nama' => 'Anak',
                'deskripsi' => 'lorem ipsum',
            ],
            [
                'nama' => 'Penyakit Dalam',
                'deskripsi' => 'lorem ipsum',
            ],
            [
                'nama' => 'lorem ipsum',
                'deskripsi' => 'lorem ipsum',
            ]
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
