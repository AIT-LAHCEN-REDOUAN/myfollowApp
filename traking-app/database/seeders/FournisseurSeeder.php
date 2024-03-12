<?php

namespace Database\Seeders;

use App\Models\fournisseurs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        fournisseurs::factory()->count(5)->create();
    }
}
