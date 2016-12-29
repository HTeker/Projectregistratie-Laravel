<?php

class ClassroomsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /classrooms
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('classrooms.index')
			->with('classrooms', Classroom::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /classrooms/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$cohorts_db = Cohort::all();

		$cohorts = ['default'=>'Selecteer een cohort'];

		foreach($cohorts_db as $cohorts_db)
		{
			$cohorts[$cohorts_db->id] = $cohorts_db->naam . " (" . $cohorts_db->id . ")";
		}

		return View::make('classrooms.create')
			->with('cohorts', $cohorts);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /classrooms
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\Classroom;

	    if($validation->passes())
	    {
	    	Classroom::create(Input::all());

	    	return Redirect::route('classrooms.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /classrooms/{id}
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
	 * GET /classrooms/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('classrooms.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /classrooms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Classroom;

	    if($validation->passes())
	    {
	    	$classroom = Classroom::where('id', '=', $id)->first();
	    	$classroom->naam = Input::get('naam');
	    	$classroom->cohort = Input::get('cohort');
	    	$classroom->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /classrooms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$classroom = Classroom::where('id', '=', $id)->get();

		Classroom::where('id', '=', $id)->delete();

		return Response::json($classroom);
	}

	public function delete()
	{
		return View::make('classrooms.delete')
			->with('classrooms', Classroom::all());
	}


	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Classroom::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('naam', 'LIKE', '%'.$q.'%')->with('cohorts')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Classroom::where('id', '=', $q)->get();

		    $result['cohorts'] = Cohort::all();

	    	return Response::json($result);
		}
	}

}