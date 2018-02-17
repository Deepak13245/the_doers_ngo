<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('description');
            $table->char('title');
            $table->char('address');
            $table->timestamp('start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('category_id')->unsigned();
            $table->integer('interest_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('events');
    }
}
