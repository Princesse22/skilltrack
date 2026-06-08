public function up(): void
{
    Schema::create('formateurs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nom');
        $table->string('phone');
        $table->integer('annees_experience');
        $table->text('bibliographie');
        $table->date('date_naissance');
        $table->string('statut')->default('pending');
        $table->string('photo_profil')->nullable();
        $table->string('photo_diplome')->nullable();
        $table->timestamps();
    });
}
