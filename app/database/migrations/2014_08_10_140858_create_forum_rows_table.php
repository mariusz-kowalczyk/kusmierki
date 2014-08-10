<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumRowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_rows', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('text', 800);
                        $table->integer('user_id')->unsigned()->nullable();
                        $table->integer('forum_topic_id')->unsigned();
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
                        $table->foreign('forum_topic_id')->references('id')->on('forum_rows')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forum_rows');
	}

}
