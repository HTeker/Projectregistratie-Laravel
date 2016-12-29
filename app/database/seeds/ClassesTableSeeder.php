<?php

class ClassesTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$classes = [
			['naam' => 'AO2',
			'cohort' => '1',
			'created_at' => $nu],
			['naam' => 'AO1',
			'cohort' => '3',
			'created_at' => $nu],
			['naam' => 'IB1',
			'cohort' => '2',
			'created_at' => $nu],
		];

		DB::table('classrooms')->insert($classes);
	}

}