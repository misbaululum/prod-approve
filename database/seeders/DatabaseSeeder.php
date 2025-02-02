<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Promise\Create;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserKaGroupDivisiSeeder::class,
        ]);
    }
}