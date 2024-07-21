<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Kagroup;

class UserKaGroupDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat divisi mulsa
        $mulsa = Divisi::create([
            'nama' => 'Mulsa',
            'active' => 1
        ]);
        
        // Buat divisi botol
        $botol = Divisi::create([
            'nama' => 'Botol',
            'active' => 1
        ]);
        
        // Buat divisi pestisida
        $pestisida = Divisi::create([
            'nama' => 'Pestisida',
            'active' => 1
        ]);
        
        // Buat divisi plastik
        $plastik = Divisi::create([
            'nama' => 'Plastik',
            'active' => 1
        ]);

        // Buat user untuk Ka Group Mulsa
        $kagroup_mulsa = User::factory()->create([
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


        $kagroup_mulsa->atasan()->attach([
            $spv_mulsa->id => ['level' => 1],
            $kabag_mulsa->id => ['level' => 2],
        ]);

        $spv_mulsa->atasan()->attach([
            $kabag_mulsa->id => ['level' => 1],
        ]);

        // Buat KaGroup untuk user yang baru dibuat
        $kagroup_mulsa->kagroup()->create([
            'nama' => $kagroup_mulsa->nama,
            'divisi_id' => $mulsa->id,
            'nama_divisi' => $mulsa->nama,
            'jenis_kelamin' => 'L',
        ]);
    }
}