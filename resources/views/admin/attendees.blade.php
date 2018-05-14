@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('AttendeesController@index') }}">Attendees</a></li>
</ul>

<div class="row">
  <h1>Attendee Administration</h1>
  {{ csrf_field() }}
  <div class="small-12 medium-6 column">
  <fieldset>
    <legend>Attendees</legend>
    @if($attendees->count() > 0)
      <table border = "1" id="majors_table">
      <thead>
        <th width="150">First Name</th>
        <th width="150">Last Name</th>
        <th width="150">Email</th>
        <th width="150">Phone Number</th>
        <th width="150">Type</th>
        <th width="150">Visitors</th>
        <th width="150">View Attendee</th>
      </thead>
      @foreach ($attendees as $attendee)
        <tr>
          <td>{{ $attendee->firstName }}</td>
          <td>{{ $attendee->lastName }}</td>	
          <td>{{ $attendee->email }}</td>
          <td>{{ $attendee->phone }}</td>	
          @if($attendee->studentType != null)
          <td>{{ $studentTypes[$attendee->studentType-1]->name }}</td>
          @else
          <td>{{ "Unknown" }}</td>
          @endif
          <td>{{ $attendee->visitors }}</td>	

          <td>
            <form method = "get" action = "{{action('AttendeesController@show',['id'=>$attendee->id])}}">
              <input class = "button" type = "submit" value = "View Attendee">
              </form>
          </td>
        </tr>
      @endforeach
    @else
      <h3>There are no Attendees to Display</h3>
    @endif
 
    

    </table>
    {{ $attendees->links()}}
  </fieldset>

    <form method = "post" action = "{{route('attendee.search')}}">
    {{ csrf_field() }}
      <fieldset>
        <h3>Search By Parameter</h3>
        <label for = "parameter">Search Parameter:
        <select name = "parameter">
          <option value = "firstName">First Name</option>
          <option value = "lastName">Last Name</option>
          <option value = "tour_id">Tour ID</option>
          <option value = "email">Email</option>
          <option value = "phone">Phone</option>
          <option value = "visitors">Visitors</option>
        </select>
        <input type = "text" name = "searchValue">
        <input class = "button" type = "submit" value = "Search">
      </fieldset>
    </form>

    <form method = "post" action = "{{route('attendee.search.date')}}">
    {{ csrf_field() }}
      <fieldset>
        <h3>Search By Date</h3>
          <label for="filterDateStart">Start Date
            <input type="date" id="filterDateStart" name="filterDateStart" />
          </label>
          <label for="filterDateEnd">End Date
            <input type="date" id="filterDateEnd" name="filterDateEnd" />
          </label>
          <input class = "button" type = "submit" value = "Search">
      </fieldset>
    </form>


    <form method = "get" action = "{{route('student.status')}}">
      <input class = "button" type = "submit" value = "View Student Statuses">
    </form>
  </div>
</div>


@endsection