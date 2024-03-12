<?php

use App\Models\colies;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("Colies",function(Blueprint $table){
            $table->string("Reference")->primary();
            $table->string("Qr_code")->nullable();
            $table->string("Designation");
            $table->integer("Qte_Unitaire");
            $table->unsignedBigInteger("id_Fournisseur");
            $table->string("Prix");
            $table->foreign("id_Fournisseur")->references("id")->on("Fournisseurs")->onUpdate("cascade");
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("Colie");
    }
};
