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
        Schema::create('venuetypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('venues_id')->unsigned()->index();
            $table->bigInteger('venuetypelists_id')->unsigned()->index();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('venues_id')
                ->references('id')->on('venues')
                ->onDelete('cascade');

            $table->foreign('venuetypelists_id')
                ->references('id')->on('venuetypelists')
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
        Schema::table('venuetypes', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['venues_id']);
            $table->dropForeign(['venuetypelists_id']);
        });
        Schema::dropIfExists('venuetypes');
    }
};
