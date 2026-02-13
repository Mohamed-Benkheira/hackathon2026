<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weekly_exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekly_session_id')->constrained('weekly_sessions')->onDelete('cascade');
            $table->date('exception_date');
            $table->string('reason')->nullable();
            $table->boolean('is_cancelled')->default(true);
            $table->timestamps();

            $table->index('exception_date');
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
        Schema::dropIfExists('weekly_exceptions');
    }
};
