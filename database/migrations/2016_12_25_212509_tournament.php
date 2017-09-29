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
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('early_reg_end')->nullable();
            $table->boolean('completed')->default(false);
            $table->longText('details');
            $table->longText('crosstable');
            $table->longText('pairings');
            $table->longText('report');
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
        Schema::drop('tournaments');
    }
}
