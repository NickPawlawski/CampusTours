@extends('layouts.app')

@section('content')
<head>
  <script>
    function getMonths(){
      var d = new Date;
      var i = d.getMonth();

      var months = ["January","Febuary","March","April","May"];


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
              <label for="tourDates">Choose a Month</label>
                <div>
                  <input type = "submit" id = "first"  name = "a" value = "1">
                  <input type = "submit" id = "second" name = "a" value = "2">
                  <input type = "submit" id = "third"  name = "a" value = "3">
                  <input type = "hidden" name = "token" value = "{{$attendee->token}}">
                </div>
              </div>
        </form>
    </div>  
</div>
</body>


@endsection