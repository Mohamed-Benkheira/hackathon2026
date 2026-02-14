// database/migrations/xxxx_create_wilaya_economies_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wilaya_economies', function (Blueprint $table) {
            $table->id();
            $table->string('wilaya', 50)->unique();
            $table->decimal('agriculture_pct', 5, 2)->default(0);
            $table->decimal('industry_pct', 5, 2)->default(0);
            $table->decimal('services_pct', 5, 2)->default(0);
            $table->decimal('tourism_pct', 5, 2)->default(0);
            $table->integer('population')->nullable();
            $table->timestamps();
        });

        // Add wilaya columns to institutes
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('wilaya', 50)->after('name')->nullable();
            $table->string('code', 20)->after('name')->nullable()->unique();
            $table->integer('capacity')->after('wilaya')->default(500);
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn(['wilaya', 'code', 'capacity']);
        });
        Schema::dropIfExists('wilaya_economies');
    }
};
