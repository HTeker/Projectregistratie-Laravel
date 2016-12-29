<?php

class CohortsTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$cohorts = [
			['naam' => 'AO 2013-2014',
			'crebo' => '1',
			'created_at' => $nu],
			['naam' => 'IB 2014-2015',
			'crebo' => '2',
			'created_at' => $nu],
			['naam' => 'AO 2014-2015',
			'crebo' => '1',
			'created_at' => $nu]
		];

		DB::table('cohorts')->insert($cohorts);
	}

}