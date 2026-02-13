<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->decimal('controle1', 4, 2)->nullable();
            $table->decimal('controle2', 4, 2)->nullable();
            $table->decimal('examen_final', 4, 2)->nullable();
            $table->decimal('moyenne_module', 4, 2)->nullable()->storedAs('(controle1 + controle2 + examen_final) / 3');
            $table->integer('coefficient')->default(1);
            $table->decimal('moyenne_ponderee', 5, 2)->nullable()->storedAs('((controle1 + controle2 + examen_final) / 3) * coefficient');
            $table->enum('status', ['pending', 'validated', 'pass', 'fail'])->default('pending');
            $table->timestamps();

            $table->unique(['student_id', 'module_id']);
            $table->index(['student_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_grades');
    }
};
