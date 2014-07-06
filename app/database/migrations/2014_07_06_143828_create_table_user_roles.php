<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_roles', function(Blueprint $table)
		{
                    $table->integer('user_id')->unsigned();
                    $table->integer('role_id')->unsigned();
                    
                    $table->primary(array('user_id', 'role_id'));
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_roles');
	}

}
