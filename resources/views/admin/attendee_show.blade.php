@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('attendees.index') }}">Attendees</a></li>
	<li class="current"><a href="{{ action('AttendeesController@show', ['id' => $attendee->id]) }}">Attendee</a></li>
</ul>

<div>
  <h1>Attendee: {{ $attendee->firstName }} {{$attendee->lastName}}</h1>
	
		<table border = "1" id="majors_table">
			<thead>
				<th width="150">
					First Name
				</th>
				<th width="150">
					Last Name
				</th>
				<th width="150">
					Email
				</th>
				<th width="150">
					Phone Number
				</th>
				<th width="150">
					Type
				</th>
				<th width="150">
					Visitors
				</th>
			</thead>
			
			<tr>
				<td>{{ $attendee->firstName }}</td>
				<td>{{ $attendee->lastName }}</td>	
				<td>{{ $attendee->email }}</td>
				<td>{{ $attendee->phone }}</td>	
				<td>{{ $attendee->studentType }}</td>
				<td>{{ $attendee->visitors }}</td>	
			</tr>
		</table>
</div>



@endsection
