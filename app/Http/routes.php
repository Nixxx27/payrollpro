<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
// Route::get('home', 'HomeController@index');


 // Route::get('/nikko', function(){
 //        return view('nikko');
	// 	});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



/**
 * NZ knows!
 *
 * Authenticate user only can access this pages.
 */
Route::group(['middleware' => ['auth']],
    function () {

 	Route::get('home', function(){
        return view('pages.employees.list');
		});


        Route::get('nikko', function(){
        return view('pages.nikko');
		});

        //Flight Controller
		Route::resource('flight', 'FlightController');

		//Aircraft Controller
		Route::resource('aircraft', 'AircraftController');

		//Survey Controller
		// Route::GET('survey/served','SurveyController@mark_served');
		Route::GET('survey/add_remarks','SurveyController@add_remarks');
		Route::POST('survey/change_inactive','SurveyController@change_to_inactive');
		Route::POST('survey/add_special_meal','SurveyController@add_special_meal');
		Route::resource('survey', 'SurveyController');


		//Message Controller
		Route::resource('message', 'MessageController');
		Route::POST('message/add_from_show','MessageController@add_from_show');

		//Change Aircraft Controller
		Route::resource('change_aircraft', 'ChangeAircraftController');


		//Actual Pax Controller
		Route::resource('actual', 'ActualPaxController');
		Route::POST('actual/add_from_show','ActualPaxController@add_from_show');
		
		//Ajax Controller
		Route::GET('auto_flight_num','AjaxController@auto_flight_num');
		Route::GET('auto_aircraft_type','AjaxController@auto_aircraft_type');
		Route::GET('survey_messages','AjaxController@survey_messages');


		/* Archives 
		* Survey Served DB
		*	
		*/
		Route::POST('survey/arc_srvd','ArchivedController@served');
		Route::POST('survey/arc_cancel','ArchivedController@arc_canc_noop');
		Route::POST('survey/arc_noop','ArchivedController@arc_canc_noop');


		/* View All Records in Served, Cancelled, Noop.
		* Retrieving Archives
		*/
		Route::GET('archived_survey/cancel','ArchivedController@view_cancel');
		Route::GET('archived_survey/noop','ArchivedController@view_noop');
		Route::resource('archived_survey', 'ArchivedController');

		/*Export to Excel
		*
		*/
		Route::GET('survey/export/{id}','ExcelController@export_to_excel_solo');
		Route::GET('arc_survey/export/{id}','ExcelController@export_to_excel_solo_arc');

		/*Print to PDF
		*
		*/
		Route::GET('survey/pdf/{id}','PdfController@pdf_solo');
		Route::GET('arc_survey/pdf/{id}','PdfController@pdf_solo_arc');


		/* Nikko Controller 
		*  Mixed Methods
		*	
		*/
		Route::get('reminders','NikkoController@reminders');
		Route::POST('reminders/create','NikkoController@add_reminders');
		Route::DELETE('reminders/{id}','NikkoController@delete_reminders');

		/* Sample Controller 
		*  sample Methods
		*	
		*/
		Route::GET('nz',function(){
			$msg = App\message::all();
			foreach ($msg as $msgs)
			{
				echo	$msgs->updated_at . ' belongs to'.   $msgs->nzmessage->flight_num   .'<br>' ;
			}
		});

		Route::GET('nz1/{id}',function($id){
			 $survey = App\survey::find($id);
			 echo "<ul>";
			foreach ($survey->message as $msg)
			{
				echo	'<li>' .$msg->date    .'</li>' ;
			}
			echo "</ul>";
		});



});