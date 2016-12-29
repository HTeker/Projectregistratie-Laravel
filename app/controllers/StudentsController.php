<?php

class StudentsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /students
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('students.index')
			->with('students', Student::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /students/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$statuses_db = DB::table('statuses')->get();

		$statuses = ['default'=>'Selecteer een status'];

		foreach($statuses_db as $status_db)
		{
			$statuses[$status_db->id] = $status_db->naam;
		}


		$classrooms_db = Classroom::all();

		$classrooms = ['default'=>'Selecteer een klas'];

		foreach($classrooms_db as $classroom_db)
		{
			$classrooms[$classroom_db->id] = $classroom_db->naam . " (" . $classroom_db->id . ")";
		}

		return View::make('students.create')
			->with('statuses', $statuses)
			->with('classrooms', $classrooms);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /students
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\Student;

	    if($validation->passes())
	    {
	    	Student::create(Input::all());

	    	return Redirect::route('students.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /students/{id}
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
	 * GET /students/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('students.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Student;

	    if($validation->passes())
	    {
	    	$student = Student::where('id', '=', $id)->first();
	    	$student->voornaam = Input::get('voornaam');
	    	$student->tussenvoegsel = Input::get('tussenvoegsel');
	    	$student->achternaam = Input::get('achternaam');
	    	$student->status = Input::get('status');
	    	$student->klas = Input::get('klas');
	    	$student->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$student = Student::where('id', '=', $id)->get();

		Student::where('id', '=', $id)->delete();

		return Response::json($student);
	}

	public function delete()
	{
		return View::make('students.delete')
			->with('students', Student::all());
	}


	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Student::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('voornaam', 'LIKE', '%'.$q.'%')
		    	->orWhere('tussenvoegsel', 'LIKE', '%'.$q.'%')
		    	->orWhere('achternaam', 'LIKE', '%'.$q.'%')->with('classrooms')->with('statuses')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Student::where('id', '=', $q)->get();

		    $result['statuses'] = DB::table('statuses')->get();

		    $result['classrooms'] = Classroom::all();

	    	return Response::json($result);
		}
	}

	public function searchNotAssigned(){
		$q = Input::get('query');

		$studentIds = array('0'=>'');

		$studentIds_db = DB::table('student_projects')
			->where('student_projects.project', '=', Input::get('project'))
			->join('students', 'students.id', '=', 'student_projects.leerling')->select('students.id')->get();

		foreach($studentIds_db as $studentId_db){
			foreach($studentId_db as $key){
				$studentIds[] = $key;
			}
		}

		$students = DB::table('students')
			->whereNotIn('id', $studentIds)->get();

		return Response::json($students);
	}

}

/*

$students = DB::table('student_projects')
			->join('students', 'students.id', '=', 'student_projects.leerling')
			->where('student_projects.project', '=', Input::get('project'))
			->where('students.id', 'LIKE', '%'.$q.'%')
	    	->orWhere('students.voornaam', 'LIKE', '%'.$q.'%')
	    	->orWhere('students.tussenvoegsel', 'LIKE', '%'.$q.'%')
	    	->orWhere('students.achternaam', 'LIKE', '%'.$q.'%')
			->select('students.voornaam')->get();

*/