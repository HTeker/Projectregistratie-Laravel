<?php namespace Services\Validators;

class Rating extends Validator {
	public static $rules = [
		'naam' => 'required|min:2'
	];
}