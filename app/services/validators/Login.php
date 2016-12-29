<?php namespace Services\Validators;

class Login extends Validator {
	public static $rules = [
		'email' => 'required|email',
		'wachtwoord' => 'required'
	];
}