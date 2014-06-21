<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('login');
                        $table->string('password');
                        $table->string('email');
                        $table->string('firstname');
                        $table->string('lastname');
                        $table->date('birthday')->nullable();
                        $table->tinyInteger('role')->default(User::ROLE_USER);
                        $table->tinyInteger('status')->default(User::STATUS_INACTIVE);
                        $table->string('remember_token');
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
		Schema::drop('users');
	}

}
