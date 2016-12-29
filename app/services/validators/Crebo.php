<?php namespace Services\Validators;

class Crebo extends Validator {
	public static $rules = [
		'nummer' => 'required|digits:5',
		'naam' => 'required|alpha_dash|min:2'
	];
}