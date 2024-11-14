<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venues_id')->constrained('venues')->onDelete('cascade');
            // Foreign key for `venues` table

            $table->string('category_type'); // e.g., 'event', 'property_type', 'venue_type'
            $table->unsignedBigInteger('category_id'); // e.g., event ID, property type ID

            $table->integer('weight')->default(0); // Sorting weight for this category
            $table->timestamps();

            // Add indexes for faster querying
            $table->index(['venues_id', 'category_type', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weights', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['venues_id']);
        });
        Schema::dropIfExists('weights');
    }
};
