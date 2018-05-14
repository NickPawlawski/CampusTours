<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
	public function index(Request $request)
	{
		//build a query
		$users = User::orderBy('name')
		->paginate(15)
		->all();

		return view('admin.users')->with(['users' => $users]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string', 
			'email' => 'email|required',
			'password' => 'required|min:8|max:24|confirmed',
			'username' => 'alpha_num|required'

		]);

		//create the new user
		$user = new User();

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = Hash::make($request->get('password'));
		$user->username = $request->get('username');
		$user->role_id = 1;
		$user->active = 1;

		$user->save();

		//Redirect to the main tours panel
		return redirect()->action('UserController@index');
	}

	public function make_visible(Request $request)
	{
		$user = User::find($request->get('id'));

		$user-> active = !$user->active;

		$user->save();

		return redirect()->action('UserController@index');
	}

	public function destroy(Request $request, $id)
	{
		$user = User::find($id);

		$user->delete();

		return redirect()->action('UserController@index');
	}

	public function show(Request $request, $id)
	{
		$user = User::find($id);


		return view('admin.user_show',['user' => $user]);
	}

	public function update(Request $request, $id)
	{

		$this->validate($request, [
			'name' => 'required|string',
			'email' => 'required|email',
			'password' => 'required|min:8|max:24|confirmed'
		]);

		$user = User::find($id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = Hash::make($request->get('password'));

		$user->save();

		//dd($user->email);

		return redirect()->action('UserController@index');
	}

}