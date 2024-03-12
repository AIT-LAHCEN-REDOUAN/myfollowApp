<?php

namespace Database\Factories;

use App\Models\colies;
use App\Models\fournisseurs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\colie>
 */
class coliesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $unique_QR_code = fake()->unique()->numberBetween(1000000000, 9999999999);
        while(colies::where("Reference",$unique_QR_code)->exists()){
            $unique_QR_code = fake()->unique()->numberBetween(1000000000, 9999999999);
        }
        $fournisseurs_id = fournisseurs::pluck('id')->toArray();
        return [
            "Reference"=>$unique_QR_code ,
            "Designation"=>fake()->text(15),
            "Prix"=>fake()->randomFloat(2,1,100),
            "id_Fournisseur"=>fake()->randomElement($fournisseurs_id),
            "Qte_Unitaire"=>fake()->numberBetween(1,100),
        ];
    }
}
