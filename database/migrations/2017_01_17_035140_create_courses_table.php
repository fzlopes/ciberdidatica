<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->text('description');
            $table->double('value', 10,2);
            $table->text('evaluation')->nullable();
            $table->integer('tag_id')->unsigned();
            $table->integer('module_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('student_id')->references('id')->on('students');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('courses');
	}

}
