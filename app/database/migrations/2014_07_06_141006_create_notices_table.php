<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notices', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('title');
                        $table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notices');
	}

}
