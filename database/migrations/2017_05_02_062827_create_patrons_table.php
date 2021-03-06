<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrons', function (Blueprint $table) {
            // normalized data specific to patronage
            $table->increments('id');
            $table->unsignedInteger('user_id')->index(); //unique?
            //address, donation amount, image, email, social media links

            // the idea here is to collect info about the people actually paying/donating money
            // to the charity and this will help aggregate that info in a report back to the
            // org after the event is over.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patrons');
    }
}
