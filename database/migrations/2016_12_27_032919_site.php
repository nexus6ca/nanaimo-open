<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Site extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('site_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home')->nullable()->unsigned()->length(10);
            $table->foreign('home')->references('id')->on('pages')->onDelete('cascade');
            $table->integer('next_tournament')->nullable()->unsigned()->length(10);
            $table->foreign('next_tournament')->references('id')->on('tournaments')->onDelete('cascade');
            $table->integer('previous_tournament')->nullable()->unsigned()->length(10);
            $table->foreign('previous_tournament')->references('id')->on('tournaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_pages');
    }
}
