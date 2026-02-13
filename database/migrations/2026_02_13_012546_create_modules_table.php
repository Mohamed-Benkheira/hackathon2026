<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('code', 20);
            $table->string('name_ar');
            $table->string('name_fr');
            $table->integer('coefficient')->default(1);
            $table->integer('hours_theory')->default(0);
            $table->integer('hours_practice')->default(0);
            $table->timestamps();

            $table->unique(['class_id', 'code']);
            $table->index('class_id');
            $table->foreignId('institute_id')
                ->nullable()
                ->constrained('institutes')
                ->cascadeOnDelete()
                ->after('id');

            $table->index(['institute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
