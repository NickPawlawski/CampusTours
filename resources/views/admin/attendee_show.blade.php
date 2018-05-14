@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('attendees.index') }}">Attendees</a></li>
	<li class="current"><a href="{{ action('AttendeesController@show', ['id' => $attendee->id]) }}">Attendee</a></li>
</ul>

<div>
  <h1>Attendee: {{ $attendee->firstName }} {{$attendee->lastName}}</h1>
	<form method = "POST" action = "{{ action('AttendeesController@show', ['id' => $attendee->id]) }}">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<table border = "1" id="majors_table">
			<thead>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Visitors</th>
				<th>Type</th>
			</thead>
			
			<tr>
				<td>{{ $attendee->firstName }}</td>
				<td>{{ $attendee->lastName }}</td>	
				<td>{{ $attendee->email }}</td>
				<td>{{ $attendee->phone }}</td>	
				<td>{{ $attendee->visitors }}</td>	
				@if($attendee->studentType != null)
				<td>{{ $studentTypes[$attendee->studentType-1]->name }}</td>
				@else
				<td>{{ "Unknown" }}</td>
				@endif
			</tr>
		</table>

		<table border = "1" id = "date_table">
			<thead>
				<th>Tour Date</th>
				<th>Tour Time</th>
				<th>Tour ID</th>
			</thead>

			<tr>
				<td>{{ date('m/d/Y', strtotime($tour->date))}}</td>
      			<td>{{ date('h:i A', strtotime($tour->time))}}</td>
				<td>{{ $tour->id }}</td>
			</tr>
		</table>

		<fieldset>
		<legend>Update Attendees Information</legend>
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
					<input type = "text" name = "firstName" placeholder = "{{$attendee->firstName}}">
                    @if ($errors->first('firstName'))
                        <small class="error">{{ $errors->first('firstName') }}</small>
                    @endif
				</td>
			</tr>

			<tr>
				<td>Last Name</td>
				<td>{{ $attendee->lastName }}</td>
				<td>
					<input type = "text" name = "lastName" placeholder = "{{ $attendee->lastName }}">
                    @if ($errors->first('lastName'))
                        <small class="error">{{ $errors->first('lastName') }}</small>
                    @endif 
				</td>
			</tr>

			<tr>
				<td>Email</td>
				<td>{{ $attendee->email }}</td>
				<td>
					<input type = "text" name = "email" placeholder = "{{ $attendee->email }}">
                    @if ($errors->first('email'))
                        <small class="error">{{ $errors->first('email') }}</small>
                    @endif 
				</td>
			</tr>
			
			<tr>
				<td>Visitors</td>
				<td>{{ $attendee->visitors }}</td>
				<td>
					<input type = "text" name = "Visitors" placeholder = "{{ $attendee->visitors }}">
                    @if ($errors->first('Visitors'))
                        <small class="error">{{ $errors->first('Visitors') }}</small>
                    @endif 
				</td>
			</tr>
		</table>
		
		<input class = "button" type = "submit" value = "Update Information">
		</fieldset>
	</form>
	<form  method = "GET" action = "{{ route('attendee.get_type', ['id' => $attendee->token]) }}">
	{{ csrf_field() }}
		<input type = "hidden" name = "viewPage" value = "1">
		<input class = "button" type = "submit" value = "Update Tour Information" >
	</form>
</div>



@endsection
