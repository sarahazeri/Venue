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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('venues_id')->unsigned()->index();
            $table->bigInteger('eventlists_id')->unsigned()->index();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('venues_id')
                ->references('id')->on('venues')
                ->onDelete('cascade');

            $table->foreign('eventlists_id')
                ->references('id')->on('eventlists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['venues_id']);
            $table->dropForeign(['eventlists_id']);
        });
        Schema::dropIfExists('events');
    }
};
