<?php

class TeachersTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$teachers = [
			['voornaam' => 'Vinod',
			'tussenvoegsel' => '',
			'achternaam' => 'Poenai',
			'created_at' => $nu],
			['voornaam' => 'Maarten',
			'tussenvoegsel' => '',
			'achternaam' => 'Nouwen',
			'created_at' => $nu],
			['voornaam' => 'Marcel',
			'tussenvoegsel' => '',
			'achternaam' => 'Koningstein',
			'created_at' => $nu]
		];

		DB::table('teachers')->insert($teachers);
	}

}