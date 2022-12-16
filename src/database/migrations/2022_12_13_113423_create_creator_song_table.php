<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_song', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("creator_id")->constrained("creators");
            $table->foreignId("song_id")->constrained("songs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_song');
    }
};
