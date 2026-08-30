<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manuals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('edition')->nullable();
            $table->string('coverage_start', 10)->nullable(); // e.g. "1969"
            $table->string('coverage_end', 10)->nullable();   // e.g. "1976"
            $table->string('source_file')->nullable();        // filename of PDF
            $table->text('description')->nullable();
            $table->string('publisher')->nullable();
            $table->string('part_number')->nullable();        // Cessna part number
            $table->integer('total_pages')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manuals');
    }
};
