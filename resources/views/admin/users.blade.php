@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('TourController@index') }}">Majors</a></li>
  </ul>


<div class="row">
	<div class="small-12 medium-6 column">
		<legend> Users Admin</legend>
		<table border = "1" id="majors_table">
		<thead>
			<th>
				User Name
			</th>
			<th>
				User Email
			</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>

		<td>
			<form method = "GET" action = "{{ route('user.show',$user->id) }}">
				<input class = "button" type = "submit" value = "Update User">
			</form>
		</td>

		<td>
			<form method = "POST" action = "{{ route('user.destroy',$user->id) }}">
			{{ method_field('DELETE') }}
			{{ csrf_field() }}
				<input class = "button" type = "submit" value = "Delete User">
			</form>
		</td>
	</tr>
	@endforeach
	</tbody>
	</table>


	<legend> Add User </legend>
	<form method = "POST" action = "{{ route('user.store') }}">
	{{ csrf_field() }}

	<table border = "1" id="create_user_table">
		<thead>
			<th width="150"> Info </th>
			<th width="150"> Details </th>
		</thead>
		<tbody>
			<tr>
				<td>
					<label for="Name" class="{{ $errors->first('name') ? 
						'error' : '' }}">Name</label>
				</td>
				<td>
					<input type="text" name="name" value="{{ old('name') }}">
					@if ($errors->first('name'))
					<small class="error">{{ $errors->first('name') }}</small>
					@endif
				</td>
			</tr>
			<tr>
				<td>
					<label for="User Name" class="{{ $errors->first('username') ? 'error' : '' }}">User Name</label>
				</td>
				<td>
					<input type = "text" name = "username" value="{{ old('username') }}">
					@if ($errors->first('name'))
					<small class="error">{{ $errors->first('name') }}</small>
					@endif
				</td>
			</tr>

			<tr>
				<td>
					<label for="User Email" class="{{ $errors->first('email') ? 'error' : '' }}">User Email</label>
				</td>
				<td>
					<input type = "text" name = "email" value="{{ old('email') }}">
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

	<input class = "button" type = "submit" value = "Create User">

</form>
</div>
</div>
@endsection