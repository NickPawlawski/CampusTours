@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
</ul>

<div class="row">
  <div class="small-12 medium-6 column">
    
  <form method = "post" action = "{{route('download.report')}}">
    {{ csrf_field() }}
    <input type = "hidden" name = "startDate" value = "{{$startDate}}">
    <input type = "hidden" name = "endDate" value = "{{$endDate}}">
    <input type = "submit" class = "button" value = "Download Report">
  </form>

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

        @if($attendee->startTerm!= null)
        <td>{{ $terms[$attendee->startTerm]->name}}</td>
        @else
        <td> Unknown</td>
        @endif

        @if($attendee->studentType != null)
        <td>{{ $studentTypes[$attendee->studentType-1]->name}}</td>
        @else
        <td> Unknown</td>
        @endif
        
        <td>{{ $majors[$attendee->major-1]->name}}
        <td>{{ $attendee->visitors }}</td>

        @if($attendee->attended)
          <td>{{ 'Yes' }}</td>
        @else	
          <td>{{ 'No' }}</td>
        @endif
        
        <td>
          <form method = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
          {{ csrf_field() }}
            <input class = "button" type = "submit" value = "View Attendee">
          </form>
        </td>
      </tr>
    @endforeach
    </table> 
  </div>
</div>
@endsection()