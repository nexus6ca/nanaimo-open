<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the Page Database
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->longText('entry');
            $table->integer('poster')->unsigned()->length(10);
            $table->foreign('poster')->references('id')->on('users')->onDelete('cascade');
            $table->integer('edit_by')->unsigned()->length(10)->nullable();
            $table->foreign('edit_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the Database
        Schema::drop('pages');
    }
}
