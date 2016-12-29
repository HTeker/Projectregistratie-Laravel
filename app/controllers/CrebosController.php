<?php

class CrebosController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /crebos
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('crebos.index')
			->with('crebos', Crebo::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /crebos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('crebos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /crebos
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validation = new Services\Validators\Crebo;

	    if($validation->passes())
	    {
	    	Crebo::create(Input::all());

	    	return Redirect::route('crebos.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /crebos/{id}
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
	 * GET /crebos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('crebos.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /crebos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Crebo;

	    if($validation->passes())
	    {
	    	$crebo = Crebo::where('id', '=', $id)->first();
	    	$crebo->nummer = Input::get('nummer');
	    	$crebo->naam = Input::get('naam');
	    	$crebo->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /crebos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$crebo = Crebo::where('id', '=', $id)->get();

		Crebo::where('id', '=', $id)->delete();

		return Response::json($crebo);
	}

	public function delete()
	{
		return View::make('crebos.delete');
	}

	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Crebo::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('naam', 'LIKE', '%'.$q.'%')
		    	->orWhere('nummer', 'LIKE', '%'.$q.'%')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Crebo::where('id', '=', $q)->get();

	    	return Response::json($result);
		}
	}

}