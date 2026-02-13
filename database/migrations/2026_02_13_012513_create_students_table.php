<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 20)->unique();
            $table->string('first_name_ar', 100);
            $table->string('last_name_ar', 100);
            $table->string('first_name_fr', 100)->nullable();
            $table->string('last_name_fr', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 10)->nullable();
            $table->enum('formation_type', ['apprentice', 'presential', 'remote']);
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('internship_company')->nullable();
            $table->date('internship_start_date')->nullable();
            $table->date('internship_end_date')->nullable();
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('set null');
            $table->enum('status', ['active', 'completed', 'dropped', 'suspended'])->default('active');
            $table->date('entry_date')->nullable();
            $table->timestamps();

            $table->index(['group_id', 'formation_type']);
            $table->index('matricule');
            $table->index(['last_name_ar', 'first_name_ar']);
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
        Schema::dropIfExists('students');
    }
};
