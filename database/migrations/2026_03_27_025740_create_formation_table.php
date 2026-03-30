<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formation', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->enum('status',['pending','approve', 'refuse'])->default('pending');
            $table->string('duree');
            $table->decimal('prix',10,2);
            $table->enum('devise',['XAF(FCFA)','USD($)','EUR(€)','GBP(£)'])->default('XAF(FCFA)');
            $table->decimal('remuneration',10,2);
            $table->string('image')->nullable;
            $table->string('video')->nullable;
            $table->integer('nombre_lecons');
            $table->longText('programme');
            $table->enum('langue',['Français,','Anglais','Français, & Anglais','autre']);
            $table->foreingId(formateur_id)->constrained('Users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation');
    }
};
