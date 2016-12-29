<?php

class Student extends \Eloquent {
	protected $fillable = ['voornaam','tussenvoegsel','achternaam', 'status','klas'];

	public function classrooms(){
		return $this->belongsTo('Classroom', 'klas');
	}

	public function statuses(){
		return $this->belongsTo('Status', 'status');
	}

	public function student_projects()
	{
		return $this->hasMany('AssignProject');
	}
}