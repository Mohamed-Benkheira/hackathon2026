<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');
            $table->integer('semester_number');
            $table->string('certificate', 50);
            $table->string('name_ar', 100)->nullable();
            $table->string('name_fr', 100)->nullable();
            $table->integer('duration_months')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['specialty_id', 'semester_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
