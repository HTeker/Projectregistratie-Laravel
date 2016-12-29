<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RatingsTableSeeder extends Seeder {

	public function run()
	{
		$nu = new Datetime();

		$ratings = [
			['naam' => 'Niet beoordeeld',
			'created_at' => $nu,
			'updated_at' => $nu],
			['naam' => 'Goed',
			'created_at' => $nu,
			'updated_at' => $nu],
			['naam' => 'Onvoldoende',
			'created_at' => $nu,
			'updated_at' => $nu]
		];

		DB::table('ratings')->insert($ratings);
	}

}