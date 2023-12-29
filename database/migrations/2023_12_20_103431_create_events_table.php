<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This table is responsible for storing the data from the events.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('precinct');
            $table->string('event_id');
            $table->string('event_number');
            $table->string('type_of_engagement');
            $table->string('sub_engagement');
            $table->string('classification');
            $table->text('display_address')->nullable();
            $table->dateTime('crime_date');
            $table->time('crime_time')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('neighborhood_name');
            $table->string('council_district');
            $table->string('event_subtype_type_of_event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
