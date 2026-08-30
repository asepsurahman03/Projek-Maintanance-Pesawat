<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('figures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->string('figure_number', 20);    // e.g. "1-4", "11-3"
            $table->string('title');
            $table->integer('page')->nullable();
            $table->string('image_path')->nullable();
            $table->text('caption')->nullable();
            $table->string('category')->nullable(); // e.g. "wiring", "torque", "schematic"
            $table->timestamps();

            $table->index('figure_number');
            $table->index('page');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('figures');
    }
};
