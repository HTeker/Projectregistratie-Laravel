<?php

class Teacher extends \Eloquent {
	protected $fillable = ['voornaam','tussenvoegsel','achternaam'];

	public function student_projects()
	{
		return $this->hasMany('AssignProject');
	}
}