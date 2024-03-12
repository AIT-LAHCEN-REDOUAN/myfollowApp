<?php

namespace Database\Seeders;

use App\Models\destinataires;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinataireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        destinataires::factory()->count(5)->create();
    }
}
