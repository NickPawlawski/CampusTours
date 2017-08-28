@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('majors.index') }}">Majors</a></li>
	<li class="current"><a href="{{ action('MajorsController@show', ['id' => $major->id]) }}">Show Major</a></li>
</ul>

<div class="row">
	<div class="small-12 columns">
		<h1>Major {{ $major->name }}</h1>
		
	</div>
</div>

@endsection