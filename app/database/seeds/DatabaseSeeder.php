<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('StatusesTableSeeder');
		 $this->call('RatingsTableSeeder');
		 $this->call('AccountsTableSeeder');
		 $this->call('TeachersTableSeeder');
		 $this->call('CrebosTableSeeder');
		 $this->call('CohortsTableSeeder');
		 $this->call('ClassesTableSeeder');
		 $this->call('StudentsTableSeeder');
		 $this->call('ProjectsTableSeeder');
		 $this->call('StudentProjectsTableSeeder');
	}

}