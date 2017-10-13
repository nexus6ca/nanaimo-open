<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChessclubPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_pages', function (Blueprint $table) {
            // Add chessclub page to site
            $table->integer('club')->nullable()->unsigned()->length(10);
            $table->foreign('club')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site', function (Blueprint $table) {
            //
        });
    }
}
