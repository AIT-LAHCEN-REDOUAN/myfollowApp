<?php

namespace Database\Seeders;

use App\Models\colies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        colies::factory()->count(5)->create();
    }
}
