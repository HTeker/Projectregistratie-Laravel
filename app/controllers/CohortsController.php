<?php

class CohortsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /cohorts
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('cohorts.index')
			->with('cohorts', Cohort::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /cohorts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$crebos_db = Crebo::all();

		$crebos = ['default'=>'Selecteer een crebo'];

		foreach($crebos_db as $crebo_db)
		{
			$crebos[$crebo_db->id] = $crebo_db->naam . " (" . $crebo_db->nummer . ")";
		}

		return View::make('cohorts.create')
			->with('crebos', $crebos);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cohorts
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validation = new Services\Validators\Cohort;

	    if($validation->passes())
	    {
	    	Cohort::create(Input::all());

	    	return Redirect::route('cohorts.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /cohorts/{id}
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
	 * GET /cohorts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('cohorts.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /cohorts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Cohort;

	    if($validation->passes())
	    {
	    	$cohort = Cohort::where('id', '=', $id)->first();
	    	$cohort->naam = Input::get('naam');
	    	$cohort->crebo = Input::get('crebo');
	    	$cohort->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /cohorts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function destroy($id)
	{
		$cohort = Cohort::where('id', '=', $id)->get();

		Cohort::where('id', '=', $id)->delete();

		return Response::json($cohort);
	}

	public function delete()
	{
		return View::make('cohorts.delete')
			->with('cohorts', Cohort::all());
	}


	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Cohort::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('naam', 'LIKE', '%'.$q.'%')->with('crebos')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Cohort::where('id', '=', $q)->get();

		    $result['crebos'] = Crebo::all();

	    	return Response::json($result);
		}
	}

}