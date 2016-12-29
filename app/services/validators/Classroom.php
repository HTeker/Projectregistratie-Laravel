<?php namespace Services\Validators;

class Classroom extends Validator {
	public static $rules = [
		'naam' => 'required|alpha_num|min:2',
		'cohort' => 'required|not_in:default'
	];
}