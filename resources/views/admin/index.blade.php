@extends('layouts.app')

@section('content')

<head>
	<style>
		.button{
			display:inline-block;	
			position:relative;
			vertical-align:middle;
			text-align:center;
			width:150px;
		}
	</style>
</head>
	

<ul class="breadcrumbs">
	<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
</ul>

<div>	
	<h1>Campus Tours Administration Page</h1>

	

	<div class="row column">
		<ul class="stack button-group" >
			<li><a class = "button"  href="{{ url('admin/tours') }}">Tours</a></li><br>
			<li><a class="button" href="{{ url('admin/majors') }}">Majors</a></li><br>
			<li><a class="button" href="{{ url('admin/attendees') }}">Attendees</a></li><br>
			<li><a class="button" href="{{ url('admin/user') }}">Users</a></li><br>
			<li><a class="button" href="{{ url('admin/reportdate') }}">Report</a></li>
		</ul>
	</div>
</div>	
@endsection
