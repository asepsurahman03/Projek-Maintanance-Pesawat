<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aircraft_models', function (Blueprint $table) {
            $table->id();
            $table->string('popular_name');         // e.g. "Skyhawk", "172M"
            $table->string('model');                // e.g. "172M", "F172M"
            $table->string('year', 10);             // e.g. "1974"
            $table->string('serial_beginning')->nullable(); // e.g. "17265522"
            $table->string('serial_ending')->nullable();    // e.g. "17266521"
            $table->string('engine')->nullable();
            $table->text('notes')->nullable();
            $table->integer('source_page')->nullable();
            $table->timestamps();

            $table->index('model');
            $table->index('year');
            $table->index('serial_beginning');
            $table->index('serial_ending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aircraft_models');
    }
};
