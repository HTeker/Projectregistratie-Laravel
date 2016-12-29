<?php

class ProjectsTableSeeder extends Seeder{

	public function run()
	{
		$nu = new Datetime();

		$projects = [
			['naam' => 'HTML & CSS',
			'beschrijving' => 'In dit project moet een portfolio website gemaakt worden door middel van HTML en CSS',
			'created_at' => $nu],
			['naam' => 'PHP Basis',
			'beschrijving' => 'In dit project moet een website gemaakt worden door middel van PHP en procedureel programmeren.',
			'created_at' => $nu],
			['naam' => 'PHP Laravel',
			'beschrijving' => 'In dit project moet een website gemaakt worden door middel van PHP en Laravel.',
			'created_at' => $nu],
			['naam' => 'Winform',
			'beschrijving' => 'In dit project moet een boter-kaas-en-eieren-spel gemaakt worden door middel van C# en Winforms.',
			'created_at' => $nu],
			['naam' => 'PHP Basis',
			'beschrijving' => 'In dit project moet een voorraadbeheer webapplicatie gemaakt worden door middel van C# en ASP.NET.',
			'created_at' => $nu]
		];

		DB::table('projects')->insert($projects);
	}

}