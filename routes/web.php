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
Route::post('/','HomeController@store')->name('home.store');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function() {
    Route::get('/', 'HomeController@admin');
    Route::resource('user', 'UserController');

    Route::group([
        'prefix' => 'tours'
    ], function() {
        Route::get('/', 'TourController@index');
        Route::post('/','TourController@store');
        Route::post('/multiple', 'TourController@storeMultiple');
        Route::delete('/{id}', 'TourController@delete');
        // Deleted tours for restoration
        Route::get('/deleted', 'TourController@deleted');
        Route::get('/{id}', 'TourController@show');
        Route::post('/{id}/restore', 'TourController@restore');
    });

    Route::resource('majors','MajorsController');
    Route::group([
        'prefix' => 'majors'
    ], function() {
        
        Route::post('/make_visible','MajorsController@make_visible');
        
    });

    Route::resource('attendees','AttendeesController');
    Route::group([
        'prefix' => 'attendee'
    ], function(){
        
        Route::get('/student_status','StudentStatusController@index')->name('student.status');
        Route::put('/student_status/{id}','StudentStatusController@update')->name('student.status.update');
        Route::delete('/student_status/{id}','StudentStatusController@delete')->name('student.status.delete');
        Route::post('/student_status','StudentStatusController@create')->name('student.status.create');
    });

    Route::resource('user','UserController');
    Route::group([
        'prefix' => 'user'
    ], function(){

    });
});
