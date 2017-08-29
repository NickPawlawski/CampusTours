@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('AttendeesController@index') }}">Attendees</a></li>
</ul>

<div class="row">
  <div class="small-12 medium-6 column">
    <legend> Majors Admin</legend>
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
        @foreach ($attendees as $attendee)
        <td>{{ $attendee->firstName }}</td>
        <td>{{ $attendee->lastName }}</td>	
        <td>{{ $attendee->email }}</td>
        <td>{{ $attendee->phone }}</td>	
        <td>{{ $attendee->studentType }}</td>
        <td>{{ $attendee->visitors }}</td>	

        <td>
          <form menthod = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
            <input class = "button" type = "submit" value = "View Attendee">
        </td>

        @endforeach


    </table>
  </div>
</div>


@endsection