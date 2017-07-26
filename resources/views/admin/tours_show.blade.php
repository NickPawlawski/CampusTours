@extends('layouts.app')

@section('content')

<div class="row">
	<div class="small-12 columns">
		<h1>Tour {{ $tour->id }}</h1>
		<h3>Time</h3>
		<p>{{ date('m/d/Y h:i A', strtotime($tour->date . ' ' . $tour->time))}}</p>
	</div>
</div>

@endsection