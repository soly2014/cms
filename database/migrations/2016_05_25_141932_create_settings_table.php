<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ar_sitename');
            $table->string('en_sitename');
            $table->string('email'); // 255
            $table->string('url'); // 255
            $table->longtext('keywords'); // open char
            $table->longtext('description');
            $table->integer('maintenance');
            $table->longtext('maintenance_message');
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
        Schema::drop('settings');
    }
}
