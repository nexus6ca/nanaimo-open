<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tournament extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create tournament table
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->date('early_reg_end')->nullable();
            $table->boolean('completed')->default(false);
            $table->int('page_id')->unsigned()->length(10);
            $table->foreign('page_id')->references('id')->on('page')->onDelete('cascade');
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
        Schema::drop('tournaments');
    }
}
