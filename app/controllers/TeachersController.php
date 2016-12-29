<?php

class TeachersController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /teachers
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('teachers.index')
			->with('teachers', Teacher::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teachers/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teachers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teachers
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\Teacher;

	    if($validation->passes())
	    {
	    	Teacher::create(Input::all());

	    	return Redirect::route('teachers.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /teachers/{id}
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
	 * GET /teachers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('teachers.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /teachers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Teacher;

	    if($validation->passes())
	    {
	    	$teacher = Teacher::where('id', '=', $id)->first();
	    	$teacher->voornaam = Input::get('voornaam');
	    	$teacher->tussenvoegsel = Input::get('tussenvoegsel');
	    	$teacher->achternaam = Input::get('achternaam');
	    	$teacher->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /teachers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$teacher = Teacher::where('id', '=', $id)->get();

		Teacher::where('id', '=', $id)->delete();

		return Response::json($teacher);
	}

	public function delete()
	{
		return View::make('teachers.delete');
	}

	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Teacher::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('voornaam', 'LIKE', '%'.$q.'%')
		    	->orWhere('tussenvoegsel', 'LIKE', '%'.$q.'%')
		    	->orWhere('achternaam', 'LIKE', '%'.$q.'%')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Teacher::where('id', '=', $q)->get();

	    	return Response::json($result);
		}
	}

}