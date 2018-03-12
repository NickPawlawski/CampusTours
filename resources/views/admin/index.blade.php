@extends('layouts.app')

@section('content')
	<ul class="breadcrumbs">
		<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	</ul>

	<h1>Campus Tours Administration Page</h1>

	<style>
	ul li a.button{
		width:150px;
		display:block;	
		margin-left:auto;
		margin-right:auto;	
	}
	
	</style>

	<div class="row column">
		<ul class="stack button-group">
			<li><a class="button" href="{{ url('admin/tours') }}">Tours</a></li><br>
			<li><a class="button" href="{{ url('admin/majors') }}">Majors</a></li><br>
			<li><a class="button" href="{{ url('admin/attendees') }}">Attendees</a></li><br>
			<li><a class="button" href="{{ url('admin/user') }}">Users</a></li><br>
			<li><a class="button" href="{{ url('admin/reportdate') }}">Report</a></li>
		</ul>
	</div>
@endsection
