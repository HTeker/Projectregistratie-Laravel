<?php

class Status extends \Eloquent {
	protected $fillable = ['naam'];

	public function students()
	{
		return $this->hasOne('Student');
	}
}