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
        Schema::table('songs', function (Blueprint $table) {
            $table->string("audio_source");
            $table->string("movie_source");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('songs', function (Blueprint $table) {
            //
            $table->dropColumn("audio_source");
            $table->dropColumn("movie_source");
        });
        Schema::enableForeignKeyConstraints();
    }
};
