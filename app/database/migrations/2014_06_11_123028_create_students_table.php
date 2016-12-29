<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('voornaam');
			$table->string('tussenvoegsel');
			$table->string('achternaam');
			$table->integer('klas')->unsigned();
			$table->foreign('klas')->references('id')->on('classrooms')
					->onDelete('cascade')->onUpdate('cascade');
			$table->string('status');
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
		Schema::drop('students');
	}

}
