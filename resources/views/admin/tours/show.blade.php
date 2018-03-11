@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ action('TourController@index') }}">Tours</a></li>
	<li class="current"><a href="">Show Tour</a></li>
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
        <th width="150">Visitors</th>
      </thead>
      @foreach ($attendees as $attendee)
        <tr>
          <td>{{ $attendee->firstName }}</td>
          <td>{{ $attendee->lastName }}</td>	
          <td>{{ $attendee->email }}</td>
          <td>{{ $attendee->phone }}</td>	
          <td>{{ $attendee->visitors }}</td>	

          <td>
            <form method = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
              <input class = "button" type = "submit" value = "View Attendee">
            </form>
          </td>
		  <td>
        
          @if($attendee->visited == 0)
          <form method = "get" action = "{{ route('email',['id'=>$attendee->token,'tourID'=>$tour->id]) }}">
            <input class = "button" type = "submit" value = "Attendee Arrival">
          </form>
          @else
            <p>Attendee Email Has Been Sent</p>
          <form method = "get" action = "{{ route('reset',['id'=>$attendee->token,'tourID'=>$tour->id]) }}" class = "attendee_reset">
            <input class = "button" type = "submit" value = "Reset Attendee Arrival">
          </form>
          @endif
        
		  </td>
        </tr>
      @endforeach
	  </table>
	</div>
</div>

<script>
    /*$("#filterDateStart").on("blur", function() {
      // If the start date is specified but the end date isn't, make them match.
      if ($("#filterDateStart").val() !== '' && $("#filterDateEnd").val() === '') {
        // Make the end date match the start.
        $("#filterDateEnd").val($("#filterDateStart").val());
      }
    });*/

    $(".attendee_reset").on("submit", function() {
      return confirm("Reset this Attendee?");
    });
  </script>
@endsection