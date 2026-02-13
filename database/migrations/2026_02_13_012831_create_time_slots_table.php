<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade');
            $table->date('exam_date');
            $table->integer('slot_number');
            $table->time('start_time');
            $table->time('end_time');

            $table->unique(['exam_session_id', 'exam_date', 'slot_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
