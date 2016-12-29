<?php namespace Services\Validators;

class Project extends Validator {
	public static $rules = [
		'naam' => 'required|alpha_spaces|min:2',
		'beschrijving' => 'required|min:15'
	];
}