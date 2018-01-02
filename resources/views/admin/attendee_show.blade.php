@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('attendees.index') }}">Attendees</a></li>
	<li class="current"><a href="{{ action('AttendeesController@show', ['id' => $attendee->id]) }}">Attendee</a></li>
</ul>

<div>
  <h1>Attendee: {{ $attendee->firstName }} {{$attendee->lastName}}</h1>
	<form method = "POST" action = "{{ action('AttendeesController@update', ['id' => $attendee->id]) }}">
		<table border = "1" id="majors_table">
			<thead>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Type</th>
				<th>Visitors</th>
			</thead>
			
			<tr>
				<td>{{ $attendee->firstName }}</td>
				<td>{{ $attendee->lastName }}</td>	
				<td>{{ $attendee->email }}</td>
				<td>{{ $attendee->phone }}</td>	
				<td>{{ $studentTypes[$attendee->studentType-1]->name }}</td>
				<td>{{ $attendee->visitors }}</td>	
			</tr>
		</table>

		<table border = "1" id = "edit_table">
			<thead>
				<th>Information Type</th>
				<th>Attendee's Information</th>
				<th>New Information</th>
			</thead>

			<tr>
				<td>First Name</td>
				<td>{{ $attendee->firstName }}</td>
				<td>
					<input type = "text" name = "firstName" value = "">
                    @if ($errors->first('firstName'))
                        <small class="error">{{ $errors->first('firstName') }}</small>
                    @endif
				</td>
			</tr>

			<tr>
				<td>Last Name</td>
				<td>{{ $attendee->lastName }}</td>
				<td>
					<input type = "text" name = "lastName" value = "">
                    @if ($errors->first('lastName'))
                        <small class="error">{{ $errors->first('lastName') }}</small>
                    @endif 
				</td>
			</tr>

			<tr>
				<td>Email</td>
				<td>{{ $attendee->email }}</td>
				<td>
					<input type = "text" name = "email" value = "">
                    @if ($errors->first('email'))
                        <small class="error">{{ $errors->first('email') }}</small>
                    @endif 
				</td>
			</tr>

			<tr>
				<td>Email</td>
				<td>{{ $attendee->email }}</td>
				<td>
					<input type = "text" name = "email" value = "">
                    @if ($errors->first('email'))
                        <small class="error">{{ $errors->first('email') }}</small>
                    @endif 
				</td>
			</tr>

		</table>

		<input class = "button" type = "submit" value = "Update Information">
	</form>
</div>



@endsection
