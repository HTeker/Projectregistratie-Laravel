<?php

class Project extends \Eloquent {
	protected $fillable = ['naam', 'beschrijving'];

	public function student_projects()
	{
		return $this->hasMany('AssignProject');
	}
}