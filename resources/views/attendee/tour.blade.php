@extends('layouts.app')

@section('content')
<head>
    
</head>
<div class="row">
	<div class="small-12 columns">
        <form method = "POST" action = "{{ route('submitTour') }}">
            <h1>Please select the tour you would like to Attend</h1>
                <script>
            
                </script>
            <input type = "submit" value = "Submit">
        </form>
    </div>  
</div>


@endsection