<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weekly_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('module_id')->nullable()->constrained('modules')->onDelete('set null');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->tinyInteger('day_of_week'); // 1=Mon, 5=Fri
            $table->time('slot_start');
            $table->time('slot_end');
            $table->tinyInteger('slot_number');
            $table->enum('session_type', ['theory', 'practice', 'lab'])->default('theory');
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->string('week_repeats', 50)->default('every_week');
            $table->timestamps();

            $table->unique(['group_id', 'day_of_week', 'slot_number']);
            $table->index(['group_id', 'day_of_week']);
            $table->index(['teacher_id', 'day_of_week', 'slot_number']);
            $table->index(['room_id', 'day_of_week', 'slot_number']);
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
        Schema::dropIfExists('weekly_sessions');
    }
};
