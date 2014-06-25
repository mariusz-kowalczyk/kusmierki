<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('gallery_id')->unsigned();
                        $table->string('name');
                        $table->text('description')->nullable();
                        $table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('CASCADE');
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
		Schema::drop('images');
	}

}
