<?php namespace Services\Validators;

class EditAccount extends Validator {
	public static $rules = [
		'voornaam' => 'required|alpha|min:2',
		'tussenvoegsel' => 'alpha_spaces|min:2',
		'achternaam' => 'required|alpha|min:2',
		'email' => 'email|unique:accounts',
		'wachtwoord' => 'alpha_num|between:6,12|confirmed',
		'wachtwoord_confirmation' => 'alpha_num|between:6,12'
	];
}