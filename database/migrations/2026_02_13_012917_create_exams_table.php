<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('restrict');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('time_slot_id')->constrained('time_slots')->onDelete('restrict');
            $table->integer('student_count');
            $table->string('status', 20)->default('scheduled');
            $table->timestamps();

            $table->unique(['exam_session_id', 'module_id', 'group_id']);
            $table->index(['exam_session_id', 'group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
