<?php

class ProjectsController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 * GET /projects
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('projects.index')
			->with('projects', Project::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projects/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projects
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new Services\Validators\Project;

	    if($validation->passes())
	    {
	    	Project::create(Input::all());

	    	return Redirect::route('projects.index');
	    }

	    return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /projects/{id}
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
	 * GET /projects/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return View::make('projects.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new Services\Validators\Project;

	    if($validation->passes())
	    {
	    	$project = Project::where('id', '=', $id)->first();
	    	$project->naam = Input::get('naam');
	    	$project->beschrijving = Input::get('beschrijving');
	    	$project->save();

	    	$result = true;
	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}


	public function destroy($id)
	{
		$project = Project::where('id', '=', $id)->get();

		Project::where('id', '=', $id)->delete();

		return Response::json($project);
	}

	public function delete()
	{
		return View::make('projects.delete');
	}

	public function search()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Project::where('id', 'LIKE', '%'.$q.'%')
		    	->orWhere('naam', 'LIKE', '%'.$q.'%')
		    	->orWhere('beschrijving', 'LIKE', '%'.$q.'%')->get();

	    	return Response::json($result);
		}
	}

	/* Preciese zoekfunctie */

	public function searchp()
	{
		if (Request::ajax())
		{
		    $q = Input::get('query');

		    $result = Project::where('id', '=', $q)->get();

	    	return Response::json($result);
		}
	}

	public function assign(){
		return View::make('projects.assignProject');
	}

	public function postAssign(){
		$validation = new Services\Validators\AssignProject;

	    if($validation->passes())
	    {
	    	$assignProject = new AssignProject;

	    	$assignProject->project = Input::get('project');
	    	$assignProject->leerling = Input::get('leerling');
	    	$assignProject->docent = Input::get('docent');
	    	$assignProject->begin_datum = Input::get('begin_datum');
	    	$assignProject->deadline = Input::get('deadline');
	    	$assignProject->save();

	    	$result = true;

	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	public function searchByCompleted(){
		$statuses_db = DB::table('statuses')->get();

		$statuses = ['default'=>'Selecteer een leerlingstatus'];

		foreach($statuses_db as $status_db)
		{
			$statuses[$status_db->id] = $status_db->naam;
		}

		return View::make('projects.searchByCompleted')
			->with('statuses', $statuses);
	}

	public function searchByCompletedQuery(){
		$projects = DB::table('student_projects')->where('student_projects.project', '=', Input::get('project'))
			->join('students', 'students.id', '=', 'student_projects.leerling')
			->where('students.status', '=', Input::get('status'))
			->join('ratings', 'ratings.id', '=', 'student_projects.beoordeling')
			->join('projects', 'projects.id', '=', 'student_projects.project')
			->select('students.voornaam','students.tussenvoegsel','students.achternaam','ratings.naam as beoordeling','student_projects.commentaar', 'projects.naam as project')->get();

		return Response::json($projects);

	}

	public function rate(){
		$ratings_db = DB::table('ratings')->get();

		$ratings = ['default'=>'Selecteer een beoordeling'];

		foreach($ratings_db as $rating_db)
		{
			$ratings[$rating_db->id] = $rating_db->naam;
		}

		return View::make('projects.rate')
			->with('ratings', $ratings);
	}

	public function searchNotCompletedByStudent(){
		if (Request::ajax())
		{
			$studentid = Input::get('studentid');

		    if($studentid != ""){
		    	$q = Input::get('query');

		    	$projects = DB::table('projects')->where('naam', 'LIKE', '%'.$q.'%')->join('student_projects', 'projects.id', '=', 'student_projects.project')->where('student_projects.leerling', '=', $studentid)->where('student_projects.beoordeling', '=', '1')->select('projects.*', 'student_projects.deadline')->get();

		    	return Response::json($projects);
		    }else{
		    	return Response::json(false);
		    }
		}
	}

	public function rateProjectByStudent(){
		$validation = new Services\Validators\RateProject;

	    if($validation->passes())
	    {
	    	$rateProject = AssignProject::where('leerling', '=', Input::get('leerling'))
	    		->where('project', '=', Input::get('project'))->first();

	    	$rateProject->beoordelingsdatum = date("Y-m-d");
	    	$rateProject->beoordeling = Input::get('beoordeling');
	    	$rateProject->deadline = Input::get('deadline');
	    	$rateProject->commentaar = Input::get('commentaar');
	    	$rateProject->save();

	    	$result = true;

	    	return Response::json($result);
	    }

	    return Response::json($validation->errors);
	}

	public function searchByClassroom(){
		$statuses_db = DB::table('statuses')->get();

		$statuses = ['default'=>'Selecteer een leerlingstatus'];

		foreach($statuses_db as $status_db)
		{
			$statuses[$status_db->id] = $status_db->naam;
		}

		return View::make('projects.searchByClassroom')
			->with('statuses', $statuses);
	}

	public function searchByClassroomQuery(){
		$projects = DB::table('student_projects')->where('student_projects.project', '=', Input::get('project'))
			->join('students', 'students.id', '=', 'student_projects.leerling')
			->join('classrooms', 'classrooms.id', '=', 'students.klas')
			->where('classrooms.id', '=', Input::get('klas'))
			->where('students.status', '=', Input::get('status'))
			->join('ratings', 'ratings.id', '=', 'student_projects.beoordeling')
			->join('projects', 'projects.id', '=', 'student_projects.project')
			->select('students.voornaam','students.tussenvoegsel','students.achternaam','ratings.naam as beoordeling','student_projects.beoordeling as beoordelingid','student_projects.deadline','student_projects.commentaar', 'projects.naam as project', 'classrooms.naam as klas')->get();

		return Response::json($projects);

	}

	public function searchByStudent(){
		return View::make('projects.searchByStudent');
	}

	public function searchByStudentQuery(){
		$projects = DB::table('student_projects')->where('student_projects.leerling', '=', Input::get('leerling'))
			->join('students', 'students.id', '=', 'student_projects.leerling')
			->join('classrooms', 'classrooms.id', '=', 'students.klas')
			->join('projects', 'projects.id', '=', 'student_projects.project')
			->join('ratings', 'ratings.id', '=', 'student_projects.beoordeling')
			->select('students.voornaam','students.tussenvoegsel','students.achternaam','classrooms.naam as klas', 'projects.naam as project', 'ratings.naam as beoordeling', 'student_projects.beoordeling as beoordelingid','student_projects.deadline', 'student_projects.commentaar')->get();

		return Response::json($projects);
	}
}