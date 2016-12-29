<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project')->unsigned();
			$table->foreign('project')->references('id')->on('projects')
					->onDelete('cascade')->onUpdate('cascade');
			$table->integer('leerling')->unsigned();
			$table->foreign('leerling')->references('id')->on('students')
					->onDelete('cascade')->onUpdate('cascade');
			$table->integer('docent')->unsigned();
			$table->foreign('docent')->references('id')->on('teachers')
					->onDelete('cascade')->onUpdate('cascade');
			$table->date('begin_datum');
			$table->date('deadline');
			$table->date('beoordelingsdatum')->nullable();
			$table->integer('beoordeling')->unsigned()->nullable()->default('1');
			$table->foreign('beoordeling')->references('id')->on('ratings')
					->onDelete('restrict')->onUpdate('cascade');
			$table->text('commentaar')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_projects');
	}

}
