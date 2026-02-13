<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_fr');
            $table->string('code', 10);
            $table->enum('role', ['apprentice', 'presential', 'remote']);

            $table->json('certificate_types')->nullable();
            $table->integer('duration_months')->nullable();
            $table->timestamps();
            $table->foreignId('institute_id')
                ->nullable()
                ->constrained('institutes')
                ->cascadeOnDelete()
                ->after('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialties');
    }
};
