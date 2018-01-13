<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSalesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_sales', function(Blueprint $table) {
            $table->double('unitary_value', 10, 2)->nullable();
            $table->integer('promotion_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();

            $table->foreign('promotion_id')->references('id')->on('promotions');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('course_id')->references('id')->on('courses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('item_sales');
	}

}
