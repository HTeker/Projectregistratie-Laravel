<?php

class RatingsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /ratings
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('ratings.index')
			->with('ratings', Rating::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ratings/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ratings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ratings
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validation = new Services\Validators\Rating;

	    if($validation->passes())
	    {
	    	Rating::create(Input::all());

	    	return Redirect::route('ratings.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /ratings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'show rating with id: '.$id;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ratings/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('ratings.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /ratings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Rating;

	    if($validation->passes())
	    {
	    	$rating = Rating::where('id', '=', $id)->first();
	    	$rating->naam = Input::get('naam');
	    	$rating->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /ratings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$rating = Rating::where('id', '=', $id)->get();

		Rating::where('id', '=', $id)->delete();

		return Response::json($rating);
	}

	public function delete()
	{
		return View::make('ratings.delete')
			->with('ratings', Rating::all());
	}


	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Rating::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('naam', 'LIKE', '%'.$q.'%')
		    	->where('id', '<>', '1')
		    	->where('id', '<>', '2')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Rating::where('id', '=', $q)
		    	->where('id', '<>', '1')
		    	->where('id', '<>', '2')->get();

	    	return Response::json($result);
		}
	}
}