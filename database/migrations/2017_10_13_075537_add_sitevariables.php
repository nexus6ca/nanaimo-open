<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSitevariables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_pages', function (Blueprint $table) {
            // Adding site variables
            $table->string('google_analytics_tag')->nullable();
            $table->string('site_name')->nullable();
            $table->string('tinymce_key')->nullable();
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
