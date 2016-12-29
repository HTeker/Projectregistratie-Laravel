<?php

class StatusesTableSeeder extends Seeder{

	public function run()
	{
		$statuses = [
			['naam' => 'actief'],
			['naam' => 'gediplomeerd'],
			['naam' => 'uitgeschreven']
		];

		DB::table('statuses')->insert($statuses);
	}

}