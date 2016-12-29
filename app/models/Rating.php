<?php

class Rating extends \Eloquent {
	protected $fillable = ['naam'];

	public function student_projects()
	{
		return $this->hasMany('AssignProject');
	}
}