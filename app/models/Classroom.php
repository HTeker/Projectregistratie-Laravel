<?php

class Classroom extends \Eloquent {
	protected $fillable = ['naam','cohort'];

	public function cohorts(){
		return $this->belongsTo('Cohort', 'cohort');
	}

	public function students()
	{
		return $this->hasOne('Student');
	}
}