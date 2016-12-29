<?php

class Cohort extends \Eloquent {
	protected $fillable = ['naam','crebo'];

	public function crebos(){
		return $this->belongsTo('Crebo', 'crebo');
	}

	public function classrooms()
	{
		return $this->hasOne('Classroom');
	}
}