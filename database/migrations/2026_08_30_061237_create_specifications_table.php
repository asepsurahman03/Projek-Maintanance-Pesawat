<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->string('category');         // e.g. "Aircraft", "Engine", "Fuel"
            $table->string('name');             // e.g. "Gross Weight", "Fuel Capacity"
            $table->string('value');            // e.g. "2300", "40"
            $table->string('unit')->nullable(); // e.g. "lbs", "U.S. gal", "psi"
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->text('notes')->nullable();
            $table->integer('source_page')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('category');
            $table->index('model');
            $table->index('year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
