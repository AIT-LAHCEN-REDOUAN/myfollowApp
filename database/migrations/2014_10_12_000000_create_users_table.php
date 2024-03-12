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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("Image")->nullable();
            $table->string("Matricule")->nullable();
            $table->string('name');
            $table->unsignedBigInteger('id_role'); // Use unsignedBigInteger for foreign keys.
            $table->string('email')->unique();
            $table->string("Ville")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("original_password");
            $table->rememberToken();
            // Define the foreign key constraint
            $table->foreign('id_role')->references('id')->on('roles')->onUpdate("cascade");
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
