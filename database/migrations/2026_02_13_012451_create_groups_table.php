<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('name', 10);
            $table->smallInteger('capacity')->default(30);
            $table->integer('current_students')->default(0);
            $table->timestamps();

            $table->unique(['class_id', 'name']);
            $table->index('class_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
