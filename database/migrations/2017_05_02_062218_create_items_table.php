<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();
            $table->string('type'); // product, door prize, 50/50, etc
            $table->string('name');
            $table->text('description');

            $table->string('image');
            $table->string('value');
            $table->string('cost'); // for reporting
            $table->text('sponsor'); //blurb about the person or business who donated the item up for raffle
            // shipping available?
            $table->timestamps();
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
        Schema::drop('items');
    }
}
