<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('link');
			$table->boolean('visibility');
                        $table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
                        
                        $table->unique('link');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sites');
	}

}
