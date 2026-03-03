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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        
            $table->string('title');
            $table->string('slug')->unique();
        
            $table->text('description')->nullable();
            $table->longText('instructions')->nullable();
        
            $table->unsignedSmallInteger('prep_time')->nullable();
            $table->unsignedSmallInteger('cook_time')->nullable();
            $table->unsignedSmallInteger('servings')->nullable();
        
            $table->string('difficulty')->nullable();   // pvz: easy/medium/hard
            $table->string('price_level')->nullable();  // pvz: €/€€/€€€
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
    
};
