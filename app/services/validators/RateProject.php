<?php namespace Services\Validators;

class RateProject extends Validator {
	public static $rules = [
		'leerling' => 'required|integer',
		'project' => 'required|integer',
		'beoordeling' => 'required|not_in:default'
	];
}