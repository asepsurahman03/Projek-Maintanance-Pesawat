<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manual_id')->constrained()->cascadeOnDelete();
            $table->string('section_number', 10);   // e.g. "11", "11A", "02"
            $table->string('title');                 // e.g. "ENGINE - LYCOMING"
            $table->text('description')->nullable();
            $table->integer('page_start')->nullable();
            $table->integer('page_end')->nullable();
            $table->string('system_slug')->nullable(); // e.g. "engine", "fuel-system"
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('section_number');
            $table->index('system_slug');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
