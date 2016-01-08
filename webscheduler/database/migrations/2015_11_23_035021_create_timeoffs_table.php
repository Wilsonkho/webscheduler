<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeoffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timeoffs', function(Blueprint $table)
		{
		
			$table->increments('id');
			$table->integer('groupID')->nullable();
			$table->string('name')->nullable();
			$table->string('status')->nullable();
			$table->dateTime('date')->nullable();
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
		Schema::drop('timeoffs');
	}

}
