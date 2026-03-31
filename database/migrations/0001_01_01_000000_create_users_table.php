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
    Schema::create('User', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        // Code de vérification envoyé par mail
        $table->string('verification_code')->nullable();
        // Indique si l'utilisateur a validé son compte
        $table->boolean('is_verified')->default(false);
        // Optionnel : expiration du code
        $table->timestamp('code_expires_at')->nullable();
        $table->enum('role', ['user', 'formateur', 'admin'])->default('user');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
