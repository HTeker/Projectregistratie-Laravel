<?php

class StudentsTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$students = [
			['voornaam' => 'Halil',
			'tussenvoegsel' => '',
			'achternaam' => 'Teker',
			'klas' => 1,
			'status' => 'gediplomeerd',
			'created_at' => $nu],
			['voornaam' => 'Hans',
			'tussenvoegsel' => '',
			'achternaam' => 'Anders',
			'klas' => 2,
			'status' => 'actief',
			'created_at' => $nu],
			['voornaam' => 'Jan',
			'tussenvoegsel' => '',
			'achternaam' => 'Klaassen',
			'klas' => 3,
			'status' => 'actief',
			'created_at' => $nu],
			['voornaam' => 'Gijs',
			'tussenvoegsel' => 'de',
			'achternaam' => 'Vries',
			'klas' => 2,
			'status' => 'actief',
			'created_at' => $nu],
			['voornaam' => 'Kees',
			'tussenvoegsel' => '',
			'achternaam' => 'Bakker',
			'klas' => 1,
			'status' => 'gediplomeerd',
			'created_at' => $nu],
			['voornaam' => 'Jaap',
			'tussenvoegsel' => 'de',
			'achternaam' => 'Boer',
			'klas' => 3,
			'status' => 'actief',
			'created_at' => $nu],
			['voornaam' => 'Michael',
			'tussenvoegsel' => '',
			'achternaam' => 'Brouwer',
			'klas' => 1,
			'status' => 'gediplomeerd',
			'created_at' => $nu]
		];

		DB::table('students')->insert($students);
	}

}