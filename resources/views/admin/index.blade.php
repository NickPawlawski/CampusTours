@extends('layouts.app')

@section('content')
	<ul class="breadcrumbs">
		<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	</ul>
	<div class="row column">
		<ul class="stack button-group">
			<li><a class="button" href="{{ url('admin/tours') }}">Tours</a></li>
		</ul>
	</div>
@endsection
