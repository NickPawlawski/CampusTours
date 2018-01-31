@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ action('TourController@index') }}">Tours</a></li>
	<li class="current"><a href="{{ action('TourController@show', ['id' => $tour->id]) }}">Show Tour</a></li>
</ul>
<div class="row">
	<div class="small-12 columns">
		<h1>Tour {{ $tour->id }}</h1>
		<h3>
      {{ date('m/d/Y', strtotime($tour->date))}}
      {{ date('h:i A', strtotime($tour->time))}}
    </h3>
  
		<table border = "1" id="majors_table">
      <thead>
        <th width="150">First Name</th>
        <th width="150">Last Name</th>
        <th width="150">Email</th>
        <th width="150">Phone Number</th>
        <th width="150">Type</th>
        <th width="150">Visitors</th>
      </thead>
      @foreach ($attendees as $attendee)
        <tr>
          <td>{{ $attendee->firstName }}</td>
          <td>{{ $attendee->lastName }}</td>	
          <td>{{ $attendee->email }}</td>
          <td>{{ $attendee->phone }}</td>	
          <td>{{ $studentTypes[$attendee->studentType-1]->name }}</td>
          <td>{{ $attendee->visitors }}</td>	

          <td>
            <form method = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
              <input class = "button" type = "submit" value = "View Attendee">
            </form>
          </td>
		  <td>
			<form method = "get" action = "{{ action('AttendeeInformationController@index',['id'=>$attendee->token]) }}">
				<input class = "button" type = "submit" value = "Attendee Arrival">
			</form>
		  </td>
        </tr>
      @endforeach
	  </table>
	</div>
</div>

@endsection