<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('dep_id');
            $table->string('ar_title');
            $table->string('en_title');
            $table->longtext('ar_content');
            $table->longtext('en_content');
            $table->string('photo');
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
        Schema::drop('news');
    }
}
