@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
  <li class="current"><a href="{{ url('admin/reportdate') }}">Report</a></li>
</ul>

  
<div class="row">
  <div class="small-12 medium-6 column">
  <h1>Report Generator</h1>
    <!-- Report Filter Form -->
    <form method="GET" action="{{ route('report') }}">
      <fieldset>
        <legend>Report Date</legend>
        <label for="filterDateStart"><strong>Start Date</strong>
          <input type="date" id="filterDateStart" name="filterDateStart"/>
        </label>
        <label for="filterDateEnd"><strong>End Date</strong>
          <input type="date" id="filterDateEnd" name="filterDateEnd"/>
        </label>
        <input class = "button" type = "submit" value = "Submit">
      </fieldset>
    </form>
  </div>
</div>

@endsection()