<?php

class Crebo extends \Eloquent {
	protected $fillable = ['naam','nummer'];

	public function cohorts()
	{
		return $this->hasOne('Cohort');
	}
}