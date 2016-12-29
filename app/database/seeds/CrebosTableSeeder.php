<?php

class CrebosTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$crebos = [
			['naam' => 'Applicatie-ontwikkeling',
			'nummer' => '79050',
			'created_at' => $nu],
			['naam' => 'ICT-Beheerder',
			'nummer' => '25189',
			'created_at' => $nu]
		];

		DB::table('crebos')->insert($crebos);
	}

}