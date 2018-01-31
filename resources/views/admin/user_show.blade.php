@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('user.index') }}">Users</a></li>
	<li class="current"><a href="{{ action('UserController@show',
		['name' => $user->name]) }}">Show User</a></li>
</ul>

<div class="row">
	<div class="small-12 columns">
		<h1>User {{$user->name}}</h1>

		<form method = "POST" action = "{{action('UserController@update', ['id' => $user->id]) }}">
		{{ csrf_field() }}
		{{ method_field('PUT') }}

		<table border="1" id=create_user_table>
			<thead>
				<th width="150"> Info </th>
				<th width="150"> Details </th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="User Name" class="{{ $errors->first('name') ? 'error' : '' }}">User Name</label>
					</td>
					<td>
						<input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}">
						@if ($errors->first('name'))
							<small class="error">{{ $errors->first('name') }}</small>
						@endif
					</td>
				</tr>

				<tr>
					<td>
						<label for="Email" class="{{ $errors->first('email') ? 'error' : '' }}">Email</label>
					</td>
					<td>
						<input type="text" name="email" value="{{ old('email') ? old('email') : $user->email }}">
						@if ($errors->first('email'))
							<small class="error">{{ $errors->first('email') }}</small>
						@endif
					</td>
				</tr>

				<tr>
					<td>
						<label for="Password" class="{{ $errors->first('password') ? 'error' : '' }}">Password</label>
					</td>
					<td>
						<input type = "password" name = "password">
						@if ($errors->first('password'))
							<small class="error">{{ $errors->first('password') }}</small>
						@endif
					</td>
				</tr>

				<tr>
					<td>
						<label for="password_confirmation" class="{{ $errors->first('password_confirmation') ?
							'error' : '' }}">Confirm Password</label>
					</td>
					<td>
						<input type="password" name="password_confirmation">
						@if ($errors->first('password_confirmation'))
							<small class="error">{{ $errors->first('password_confirmation') }}</small>
						@endif
					</td>
				</tr>
			</tbody>
		</table> 
		<input class="button" type="submit" value="Update User">
	</form>
	</div>
</div>

@endsection