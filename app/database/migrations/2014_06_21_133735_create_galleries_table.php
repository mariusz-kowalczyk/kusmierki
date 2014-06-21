<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galleries', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('parent_id')->unsigned()->nullable();
                        $table->string('name');
                        $table->text('description')->nullable();
                        $table->tinyInteger('visibility')->default(Gallery::VISIBILITY_PUBLIC);
                        $table->integer('icone')->unsigned()->nullable();
                        $table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('parent_id')->references('id')->on('galleries')->onDelete('CASCADE');
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
		Schema::drop('galleries');
	}

}
