<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->string('item');                // Short item name
            $table->string('interval', 50);        // "50 hours", "100 hours", "200 hours", "Special", "Annual"
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('source_page')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('interval');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_items');
    }
};
