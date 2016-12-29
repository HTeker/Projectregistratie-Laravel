<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCohortsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cohorts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('naam');
			$table->integer('crebo')->unsigned();
			$table->foreign('crebo')->references('id')->on('crebos')
					->onDelete('cascade')->onUpdate('cascade');
			$table->nullableTimestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cohorts');
	}

}
