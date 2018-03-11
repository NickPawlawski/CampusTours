@extends('layouts.app')

@section('content')
<head>
  <script>
    function getMonths(){
      var d = new Date;
      var i = d.getMonth();

      var months = ["January","Febuary","March","April","May","June"];


      document.getElementById("first").value = months[i];
      document.getElementById("second").value = months[i+1];
      document.getElementById("third").value = months[i+2];
    }
  </script>

</head>
<body onload="getMonths();">
<div class="row">
	<div class="small-12 columns">
        <form method = "GET" action = "{{ route('getTourSelection') }}">
        {{ csrf_field() }}
            <h1>Please select the month you would like to Attend</h1>
            <div id="q0">
              <h2>Please choose a Month</h2>
                <div>
                  <input class = "button" type = "submit" id = "first"  name = "a" value = "1">
                  <input class = "button" type = "submit" id = "second" name = "a" value = "2">
                  <input class = "button" type = "submit" id = "third"  name = "a" value = "3">
                  <input class = "button" type = "hidden" name = "attendee" value = "{{$attendee}}">
                </div>
              </div>
        </form>
    </div>  
</div>
</body>


@endsection