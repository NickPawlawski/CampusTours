@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li class="current"><a href="{{ action('HomeController@admin') }}">Admin</a></li>
</ul>

  
<div class="row">
    <div class="small-12 medium-6 column">
      <!-- Report Filter Form -->
      <form method="GET" action="{{ route('report') }}">
        <fieldset>
          <legend>Report Date</legend>
          <label for="filterDateStart">Start Date
            <input type="date" id="filterDateStart" name="filterDateStart"/>
          </label>
          <label for="filterDateEnd">End Date
            <input type="date" id="filterDateEnd" name="filterDateEnd"/>
          </label>
          <input class = "button" type = "submit" value = "Submit">
        </fieldset>
      </form>
    </div>
</div>

@endsection()