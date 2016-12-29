<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before'=>'auth', function()
{
	return View::make('main');
}));

Route::post('login', array('before'=>'guest', function(){
	$validation = new Services\Validators\Login;

    if($validation->passes())
    {
    	$userdata = array(
			'email' => Input::get('email'),
			'password' => Input::get('wachtwoord')
		);

		if (Auth::attempt($userdata)){
		    return Redirect::to('/');
		}else{
			return Redirect::back()->withInput()->withErrors('Geen geldige inloggegevens');
		}
    }

    return Redirect::back()->withInput()->withErrors($validation->errors);
}));

Route::get('/login', array('before'=>'guest', function(){
	return View::make('login');
}));

Route::get('/logout', array('before'=>'auth', function(){
	Auth::logout();
	return Redirect::to('/login');
}));

Route::post('/pdf', array('before'=>'auth', function()
{
	$html = Input::get('html');
	return PDF::load($html, 'A4', 'portrait')->show();
}));

Route::get('/projects/searchByStudentQuery', 'ProjectsController@searchByStudentQuery');
Route::get('/projects/searchByStudent', 'ProjectsController@searchByStudent');
Route::get('/projects/searchByClassroomQuery', 'ProjectsController@searchByClassroomQuery');
Route::get('/projects/searchByClassroom', 'ProjectsController@searchByClassroom');
Route::get('/projects/searchByCompletedQuery', 'ProjectsController@searchByCompletedQuery');
Route::get('/projects/searchNotCompletedByStudent', 'ProjectsController@searchNotCompletedByStudent');
Route::post('/projects/rateProjectByStudent', 'ProjectsController@rateProjectByStudent');
Route::get('/projects/rate', 'ProjectsController@rate');
Route::get('/projects/searchByCompleted', 'ProjectsController@searchByCompleted');
Route::post('/projects/postAssign', 'ProjectsController@postAssign');
Route::get('/projects/assign', 'ProjectsController@assign');
Route::get('/projects/searchp', 'ProjectsController@searchp');
Route::get('/projects/search', 'ProjectsController@search');
Route::get('projects/edit', 'ProjectsController@edit');
Route::get('projects/delete', 'ProjectsController@delete');
Route::resource('projects', 'ProjectsController');

Route::get('/students/searchNotAssigned', 'StudentsController@searchNotAssigned');
Route::get('/students/searchp', 'StudentsController@searchp');
Route::get('/students/search', 'StudentsController@search');
Route::get('students/edit', 'StudentsController@edit');
Route::get('students/delete', 'StudentsController@delete');
Route::resource('students', 'StudentsController');

Route::get('/classrooms/searchp', 'ClassroomsController@searchp');
Route::get('/classrooms/search', 'ClassroomsController@search');
Route::get('classrooms/edit', 'ClassroomsController@edit');
Route::get('classrooms/delete', 'ClassroomsController@delete');
Route::resource('classrooms', 'ClassroomsController');

Route::get('/cohorts/searchp', 'CohortsController@searchp');
Route::get('/cohorts/search', 'CohortsController@search');
Route::get('cohorts/edit', 'CohortsController@edit');
Route::get('cohorts/delete', 'CohortsController@delete');
Route::resource('cohorts', 'CohortsController');

Route::get('/crebos/searchp', 'CrebosController@searchp');
Route::get('/crebos/search', 'CrebosController@search');
Route::get('crebos/edit', 'CrebosController@edit');
Route::get('crebos/delete', 'CrebosController@delete');
Route::resource('crebos', 'CrebosController');

Route::get('/teachers/searchp', 'TeachersController@searchp');
Route::get('/teachers/search', 'TeachersController@search');
Route::get('teachers/edit', 'TeachersController@edit');
Route::get('teachers/delete', 'TeachersController@delete');
Route::resource('teachers', 'TeachersController');

Route::get('/ratings/searchp', 'RatingsController@searchp');
Route::get('/ratings/search', 'RatingsController@search');
Route::get('ratings/edit', 'RatingsController@edit');
Route::get('ratings/delete', 'RatingsController@delete');
Route::resource('ratings', 'RatingsController');

Route::get('/accounts/searchp', 'AccountsController@searchp');
Route::get('/accounts/search', 'AccountsController@search');
Route::get('accounts/edit', 'AccountsController@edit');
Route::get('accounts/delete', 'AccountsController@delete');
Route::resource('accounts', 'AccountsController');

Route::get('/deadlines/approach', array('before'=>'auth', function(){
	$nu = date("Y-m-d");
	$tweeWeken = date('Y-m-d', strtotime('+14 days', time()));

	$deadlines = DB::table('students')
		->join('student_projects', 'students.id', '=', 'student_projects.leerling')
		->join('projects', 'projects.id', '=', 'student_projects.project')
		->whereBetween('deadline', array($nu, $tweeWeken))
		->where('student_projects.beoordeling', '=', '1')
		->orWhere('student_projects.beoordeling', '=', '2')
		->select('students.voornaam', 'students.tussenvoegsel', 'students.achternaam', 'projects.naam as project', 'student_projects.deadline')->orderBy('deadline')->get();

	return View::make('deadlines.approach')
		->with('deadlines', $deadlines);
}));

Route::get('/deadlines/expire', array('before'=>'auth', function(){
	$nu = date("Y-m-d");

	$deadlines = DB::table('students')
		->join('student_projects', 'students.id', '=', 'student_projects.leerling')
		->join('projects', 'projects.id', '=', 'student_projects.project')
		->where('deadline', '<', $nu)
		->where('student_projects.beoordeling', '=', '1')
		->orWhere('student_projects.beoordeling', '=', '2')
		->select('students.voornaam', 'students.tussenvoegsel', 'students.achternaam', 'projects.naam as project', 'student_projects.deadline')->orderBy('deadline')->get();

	return View::make('deadlines.expire')
		->with('deadlines', $deadlines);
}));

Route::get('/deadline/nadert', array('before'=>'auth', function(){
	$deadlines = DB::table('students')
		->join('student_projects', 'students.id', '=', 'student_projects.leerling')
		->join('projects', 'projects.id', '=', 'student_projects.project')
		->whereBetween('deadline', array(Input::get('begin'), Input::get('eind')))
		->where('student_projects.beoordeling', '=', '1')
		->orWhere('student_projects.beoordeling', '=', '2')
		->select('students.voornaam', 'students.tussenvoegsel', 'students.achternaam', 'projects.naam as project', 'student_projects.deadline')->orderBy('deadline')->take(3)->get();

	return Response::json($deadlines);
}));

Route::get('/deadline/verlopen', array('before'=>'auth', function(){
	$deadlines = DB::table('students')
		->join('student_projects', 'students.id', '=', 'student_projects.leerling')
		->join('projects', 'projects.id', '=', 'student_projects.project')
		->where('deadline', '<', Input::get('vandaag'))
		->where('student_projects.beoordeling', '=', '1')
		->orWhere('student_projects.beoordeling', '=', '2')
		->select('students.voornaam', 'students.tussenvoegsel', 'students.achternaam', 'projects.naam as project', 'student_projects.deadline')->orderBy('deadline')->take(3)->get();

	return Response::json($deadlines);
}));

App::missing(function($exception)
{
    return Redirect::to('/');
});