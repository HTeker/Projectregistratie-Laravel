<?php namespace Services\Validators;

class Cohort extends Validator {
	public static $rules = [
		'naam' => 'required|alpha_dash|min:2',
		'crebo' => 'required|not_in:default'
	];
}