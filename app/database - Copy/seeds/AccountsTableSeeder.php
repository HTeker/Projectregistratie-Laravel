<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AccountsTableSeeder extends Seeder {

	public function run()
	{
		$accounts = [
			['voornaam' => 'Test',
			'tussenvoegsel' => '',
			'achternaam' => 'Test',
			'email' => 'test@test.nl',
			'wachtwoord' => Hash::make('test123')]
		];

		DB::table('accounts')->insert($accounts);
	}

}