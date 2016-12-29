<?php namespace Services\Validators;

class AssignProject extends Validator {
	public static $rules = [
		'project' => 'required|integer',
		'leerling' => 'required|integer',
		'docent' => 'required|integer',
		'begin_datum' => 'required|date_format:"Y-m-d"',
		'deadline' => 'required|date_format:"Y-m-d"'
	];
}