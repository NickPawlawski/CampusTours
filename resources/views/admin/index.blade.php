
@extends('layouts.app')
@section('content')



<div>	
	<h1>Campus Tours Administration</h1>
	<h2>{{ Auth::user()->name }}</h2>

	<fieldset>
	<legend>Campus Tours Administration Page</legend>
	<div class = "cont" >

		<ul class=" button-group medium-12 column" >
			<li><a class= "button medium-12" href="{{ url('admin/tours') }}">Tours</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/majors') }}">Majors</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/attendees') }}">Attendees</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/user') }}">Users</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/reportdate') }}">Report</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/bugs') }}">Report Bug</a></li>
			<li><a class= "button medium-12" href="{{ url('admin/link') }}">Add Link</a></li>
		</ul>
	</div>
	</fieldset>
</div>	
@endsection
