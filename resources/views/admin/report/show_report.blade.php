@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
</ul>

  
<div class="row">
    <div class="small-12 medium-6 column">
      <!-- Report Filter Form -->
      <legend> Report Of Attendees</legend>
      <table border = "1" id="majors_table">
      <thead>
          <th width="150">Id</th>
          <th width="150">First Name</th>
          <th width="150">Last Name</th>
          <th width="150">Email</th>
          <th width="150">Phone</th>
          <th width="150">Start Term</th>
          <th width="150">Type</th>
          <th width="150">Major</th>
          <th width="150">Visitors</th>
          <th width="150">Attended</th>
        </thead>
        @foreach ($attendees as $attendee)
        <tr>
          <td>{{ $attendee->id }}</td>	
          <td>{{ $attendee->firstName }}</td>
          <td>{{ $attendee->lastName }}</td>	
          <td>{{ $attendee->email }}</td>
          <td>{{ $attendee->phone }}</td>
          <td>{{ $terms[$attendee->startTerm]->name}}</td>		
          <td>{{ $studentTypes[$attendee->studentType-1]->name }}</td>
          <td>{{ $majors[$attendee->major-1]->name }}</td>		
          <td>{{ $attendee->visitors }}</td>

          @if($attendee->attended)
            <td>{{ 'Yes' }}</td>
          @else	
            <td>{{ 'No' }}</td>
          @endif
          
          <td>
            <form method = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
              <input class = "button" type = "submit" value = "View Attendee">
              </form>
          </td>
        </tr>
        @endforeach


    </table>
    </div>
</div>

@endsection()