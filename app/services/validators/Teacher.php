<?php namespace Services\Validators;

class Teacher extends Validator {
	public static $rules = [
		'voornaam' => 'required|alpha|min:2',
		'tussenvoegsel' => 'alpha_spaces|min:2',
		'achternaam' => 'required|alpha|min:2',
	];
}