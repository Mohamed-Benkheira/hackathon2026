<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 10)->unique()->nullable();
            $table->string('building', 50)->nullable();
            $table->integer('capacity')->nullable();
            $table->string('type', 30)->default('classroom');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('capacity');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
