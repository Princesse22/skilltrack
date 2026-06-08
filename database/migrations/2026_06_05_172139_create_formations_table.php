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
    Schema::create('formations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->string('categorie');
        $table->string('langue');
        $table->string('niveau');
        $table->text('description');
        $table->integer('nombre_lecons');
        $table->string('duree_lecon');
        $table->string('duree_totale');
        $table->text('programme');
        $table->string('public_cible');
        $table->text('objectifs');
        $table->json('competences')->nullable();
        $table->json('prerequis')->nullable();
        $table->decimal('prix', 10, 2)->default(0);
        $table->string('devise')->default('XAF');
        $table->integer('reduction')->default(0);
        $table->string('type_remuneration');
        $table->integer('partage_formateur')->default(70);
        $table->integer('score_minimum')->default(70);
        $table->string('image')->nullable();
        $table->string('video')->nullable();
        $table->string('statut')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
