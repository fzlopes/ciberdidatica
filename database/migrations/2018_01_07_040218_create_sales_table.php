<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table) {
            $table->increments('id');
            $table->date('creation_date');
            $table->double('descont_value', 10, 2)->nullable();
            $table->double('total_value', 10, 2);
            $table->enum('status', ['Emitida', 'Orçamento', 'Cancelada'])->default('Orçamento');
            $table->text('observation')->nullable();
            $table->date('date_hour_delivery');
            $table->integer('student_id')->unsigned();
            $table->timestamps();

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
		Schema::drop('sales');
	}

}
