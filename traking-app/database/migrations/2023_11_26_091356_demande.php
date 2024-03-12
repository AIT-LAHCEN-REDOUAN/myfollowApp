<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("Demande",function (Blueprint $table){
            $table->id();
            $table->string("Nom")->nullable();
            $table->string("email_pro")->nullable();
            $table->string("Nom_de_Societe")->nullable();
            $table->string("Phone_Number")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("Demande");
    }
};
