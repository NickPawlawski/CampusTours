<?php

/*
|--------------------------------------------------------------------------
| Web RoutesUs
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/stuff','MonthSelectionController@store')->name('home.store');

Route::get('/month/tour', 'HomeController@tourSelection')->name('getTourSelection');
Route::post('/month/tour/{id}', 'HomeController@saveTour')->name('submit.tour');


Route::get('login','LoginController@login')->name('login');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/attendee_information/{id}','AttendeeInformationController@index')->name('attendee.index');
Route::get('/attendee_information/{id}/type','AttendeeInformationController@get_type')->name('attendee.get_type');

Route::post('/attendee_information/{id}','AttendeeInformationController@update')->name('attendee.update');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function() {
    Route::get('/', 'HomeController@admin')->name('admin.login');
    Route::resource('user', 'UserController');

    Route::get('reportdate','GenerateReportController@index')->name('report.date');
    Route::get('report','GenerateReportController@generate')->name('report');
    Route::post('report','GenerateReportController@downloadReport')->name('download.report');

    Route::group([
        'prefix' => 'tours'
    ], function() {
        Route::get('/', 'TourController@index')->name('tour');
        Route::post('/','TourController@store');
        Route::post('/multiple', 'TourController@storeMultiple');
        Route::delete('/deleteMult', 'TourController@deleteMultiple');
        Route::delete('/{id}', 'TourController@delete');
        // Deleted tours for restoration
        Route::get('/deleted', 'TourController@deleted');
        Route::get('/{id}', 'TourController@show');
        Route::post('/{id}/restore', 'TourController@restore');

        Route::get('/email/{id}/{tourId}','TourController@sendEmail')->name('email');
        Route::get('/email/{id}/{tourId}/reset','TourController@resetAttendee')->name('reset');
    });

    Route::resource('majors','MajorsController');
    Route::group([
        'prefix' => 'majors'
    ], function() {
        Route::post('/show_active', 'MajorsController@active')->name('show.active');
        Route::post('/make_visible','MajorsController@make_visible');
        
    });

    Route::resource('attendees','AttendeesController');
    Route::group([
        'prefix' => 'attendee'
    ], function(){
       
        Route::post('/search','AttendeesController@search')->name('attendee.search');
        Route::post('/searchDate','AttendeesController@searchDate')->name('attendee.search.date');
        Route::get('/student_status','StudentStatusController@index')->name('student.status');
        Route::put('/student_status/{id}','StudentStatusController@update')->name('student.status.update');
        Route::delete('/student_status/{id}','StudentStatusController@delete')->name('student.status.delete');
        Route::post('/student_status','StudentStatusController@create')->name('student.status.create');
    });

    //Route::resource('bugs','BugsController');
    Route::group([
        'prefix' => 'bugs'
    ], function(){
        Route::post('add_bug','BugsController@addBug')->name('add.bug');
        Route::get('/sqashed_bugs','BugsController@old')->name('inactive.show');
        Route::get('/{id}','BugsController@show')->name('bug.show');
        Route::post('/{id}','BugsController@update')->name('bug.update');
        Route::get('/','BugsController@index');
    });

    Route::resource('user','UserController');
    Route::group([
        'prefix' => 'user'
    ], function(){
    
    });


    Route::group([
        'prefix' => 'link'
    ], function(){
        Route::get('/','LinkController@index');
        Route::get('/active/{id}','LinkController@changeActive')->name("change.active");
        Route::post('/','LinkController@addLink')->name("add.link");
        Route::get('/{id}', 'LinkController@deleteLink')->name("delete.link");
    });



});
