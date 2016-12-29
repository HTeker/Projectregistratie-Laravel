<?php

class AssignProject extends \Eloquent {
	protected $table = 'student_projects';

	protected $fillable = ['project', 'leerling', 'docent', 'begin_datum', 'deadline', 'beoordelingsdatum', 'beoordeling', 'commentaar'];

	public function projects(){
		return $this->belongsTo('Project', 'project');
	}

	public function students(){
		return $this->belongsTo('Student', 'student');
	}

	public function teachers(){
		return $this->belongsTo('Teacher', 'teacher');
	}

	public function ratings(){
		return $this->belongsTo('Rating', 'ratings');
	}
}