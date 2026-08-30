<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subsections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->string('paragraph_number', 20)->nullable(); // e.g. "11-20", "2-5"
            $table->string('title')->nullable();
            $table->integer('page')->nullable();
            $table->longText('content')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('paragraph_number');
            $table->index('page');
            $table->index('sort_order');
            $table->fullText(['title', 'content']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsections');
    }
};
