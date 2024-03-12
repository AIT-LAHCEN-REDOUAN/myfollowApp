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
        Schema::create('Suivi_de_tracabilites', function (Blueprint $table) {
            $table->id();
            $table->string("Reference_colie");
            $table->unsignedBigInteger("id_user");
            $table->string("etat")->nullable();
            $table->string("statut")->nullable();
            $table->string("raison")->nullable();
            $table->unsignedBigInteger("id_fournisseur");
            $table->unsignedBigInteger("id_destinataire")->nullable();
            $table->unsignedBigInteger("Quantite_apres_traitement")->nullable();
            $table->unsignedBigInteger("Quantite_avant_traitement")->nullable();
            $table->unsignedBigInteger("Quantite_Retour")->nullable();
            $table->unsignedBigInteger("Quantite_sortie")->nullable();
            $table->string("motif")->nullable();
            $table->foreign("Reference_colie")->references("Reference")->on("colies")->onUpdate("cascade");
            $table->foreign("id_user")->references("id")->on("users")->onUpdate("cascade");
            $table->foreign("id_fournisseur")->references("id")->on("fournisseurs")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Suivi_de_tracabilites');
    }
};
