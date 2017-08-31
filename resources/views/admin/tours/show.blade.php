@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ action('TourController@index') }}">Tours</a></li>
	<li class="current"><a href="{{ action('TourController@show', ['id' => $tour->id]) }}">Show Tour</a></li>
</ul>
<div class="row">
	<div class="small-12 columns">
		<h1>Tour {{ $tour->id }}</h1>
		<h3>Time</h3>
		<p>{{ date('m/d/Y h:i A', strtotime($tour->date . ' ' . $tour->time))}}</p>
	</div>
</div>

@endsection