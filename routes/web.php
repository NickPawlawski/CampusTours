<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function() {
    Route::get('/', 'HomeController@admin');

    Route::group([
        'prefix' => 'tours'
    ], function() {
        Route::get('/', 'TourController@index');
        Route::post('/','TourController@create');
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
        'prefix' => 'attendees'
    ], function(){
        
    });
});
