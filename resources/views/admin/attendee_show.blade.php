@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('attendees.index') }}">Attendees</a></li>
	<li class="current"><a href="{{ action('AttendeesController@show', ['id' => $attendee->id]) }}">Show Major</a></li>
</ul>

<div>
  <h1>Attendee: {{ $attendee->firstName }} {{$attendee->lastName}}</h1>
</div>



@endsection
