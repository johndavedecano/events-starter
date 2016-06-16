<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->nullable();
            $table->dateTime('date');
            $table->string('frequency')->default('daily');
		    $table->integer('interval');
		    $table->string('type')->default('by_date');
		    $table->integer('count')->default(1);
            $table->dateTime('until')->nullable();
            $table->text('weekdays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_settings');
    }
}
