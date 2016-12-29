<?php namespace Services\Validators;

class Account extends Validator {
	public static $rules = [
		'voornaam' => 'required|alpha|min:2',
		'tussenvoegsel' => 'alpha_spaces|min:2',
		'achternaam' => 'required|alpha|min:2',
		'email' => 'required|email|unique:accounts',
		'wachtwoord' => 'required|alpha_num|between:6,12|confirmed',
		'wachtwoord_confirmation' => 'required|alpha_num|between:6,12'
	];
}