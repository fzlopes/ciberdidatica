<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 60);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->string('cep', 20);
            $table->string('public_place', 60);
            $table->integer('number');
            $table->string('complement', 50)->nullable();
            $table->date('birth_of_date');
            $table->string('cpf', 20)->nullable();
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('students');
	}

}
