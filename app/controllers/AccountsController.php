<?php

class AccountsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /accounts
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('accounts.index')
			->with('accounts', Account::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /accounts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('accounts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /accounts
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\Account;

	    if($validation->passes())
	    {
	    	Account::create(Input::except('wachtwoord_confirmation'));

	    	return Redirect::route('accounts.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /accounts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('accounts.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\EditAccount;

	    if($validation->passes())
	    {
	    	$account = Account::where('id', '=', $id)->first();
	    	$account->voornaam = Input::get('voornaam');
	    	$account->tussenvoegsel = Input::get('tussenvoegsel');
	    	$account->achternaam = Input::get('achternaam');
	    	
			if(Input::get('email') != ""){
	    		$account->email = Input::get('email');
	    	}	    	

	    	if(Input::get('wachtwoord') != ""){
	    		$account->wachtwoord = Input::get('wachtwoord');
	    	}
	    	
	    	$account->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$account = Account::where('id', '=', $id)->get();

		Account::where('id', '=', $id)->delete();

		return Response::json($account);
	}

	public function delete()
	{
		return View::make('accounts.delete')
			->with('accounts', Account::all());
	}


	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Account::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('voornaam', 'LIKE', '%'.$q.'%')
		    	->orWhere('tussenvoegsel', 'LIKE', '%'.$q.'%')
		    	->orWhere('achternaam', 'LIKE', '%'.$q.'%')
		    	->orWhere('email', 'LIKE', '%'.$q.'%')->get();

	    	return Response::json($result);
    	}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Account::where('id', '=', $q)->get();

	    	return Response::json($result);
		}
	}
}