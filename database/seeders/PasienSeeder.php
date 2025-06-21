<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYearMonth = date('Ym');
        $patientCount = User::where('no_rm', 'like', $currentYearMonth . '-%')->count();
        $no_rm = $currentYearMonth . '-' . str_pad($patientCount + 1, 3, '0', STR_PAD_LEFT);

        User::create([
            'nama' => 'Bambang Gautama',
            'email' => 'bambang@pasien.com',
            'password' => Hash::make('pasien123'),
            'role' => 'pasien',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'no_hp' => '081234567890',
            'no_ktp' => '3175010101900001',
            'no_rm' => $no_rm,
        ]);
    }
}
