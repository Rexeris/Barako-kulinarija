<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('recipes', function (Blueprint $table) {
        $table->string('video_url')->nullable()->after('price_level');   // pvz. tiesioginis .mp4 URL
        $table->string('video_path')->nullable()->after('video_url');   // kai įkeli failą į serverį
    });
}

public function down(): void
{
    Schema::table('recipes', function (Blueprint $table) {
        $table->dropColumn(['video_url', 'video_path']);
    });
}
};
