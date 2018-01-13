<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPermissionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_permissions', function(Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('group_id')->references('id')->on('groups');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('group_permissions');
	}

}
