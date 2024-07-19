<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Divisi;

class UserKaGroupDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat divisi mulsa
        $mulsa = Divisi::create([
            'nama' => 'mulsa',
            'active' => 1
        ]);

        // Buat user untuk Ka Group Mulsa
        $staff_mulsa = User::factory()->create([
            'nama' => 'Ka Group Mulsa',
            'email' => 'kagroup@example.com',
        ]);

        // Buat user untuk SPV Mulsa
        $spv_mulsa = User::factory()->create([
            'nama' => 'SPV Mulsa',
            'email' => 'spvmulsa@example.com',
        ]);


        // Buat user untuk kabag Mulsa
        $kabag_mulsa = User::factory()->create([
            'nama' => 'kabag Mulsa',
            'email' => 'kabagmulsa@example.com',
        ]);


        $staff_mulsa->atasan()->attach([
            $spv_mulsa->id => ['level' => 1],
            $kabag_mulsa->id => ['level' => 2],
        ]);

        // Buat KaGroup untuk user yang baru dibuat
        $staff_mulsa->kagroup()->create([
            'nama' => $staff_mulsa->nama,
            'divisi_id' => $mulsa->id,
            'nama_divisi' => $mulsa->nama,
            'jenis_kelamin' => 'L',
        ]);
    }
}
