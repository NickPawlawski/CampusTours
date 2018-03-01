@extends('layouts.app')

@section('extraStyles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<link rel="stylesheet" href="{{ url('css/MonthPicker/MonthPicker.css') }}">
<link rel="stylesheet" href="{{ url('css/MonthPicker/MonthPicker.min.css') }}">
<link rel="stylesheet" href="{{ url('css/MonthPicker/test.css') }}">
<script src="{{ url('js/MonthPicker/MonthPicker.js') }}"></script>
<script src="{{ url('js/MonthPicker/MonthPicker.min.js') }}"></script>
<script src="{{ url('js/MonthPicker/jquery.maskedinput.min.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection()

@section('content')
<head>
    <base href="https://rawgit.com/KidSysco/jquery-ui-month-picker/v3.0.0/demo/">
</head>
<div class="row">
	<div class="small-12 columns">
        <form method = "POST" action = "{{ route('getTourSelection') }}">
            <h1>Please select the month you would like to Attend</h1>
            <div id="q0">
                <label for="tourDates">Choose a Month</label>
                <div id='InlineMenu'></div>

                <script type="text/javascript">
                  $("#InlineMenu").MonthPicker({
                    SelectedMonth: '04/' + new Date().getFullYear(),
                    OnAfterChooseMonth: function(selectedDate) {

                      var monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];

                      var d = new Date(selectedDate);
                      var date = d.getDate();
                      var month = ('0'+(d.getMonth()+1)).slice(-2);
                      var year = d.getFullYear();

                      var htmlDate = monthNames[d.getMonth()];
                      var fullDate = year + "-" + month + "-" + date;
                      var dbDate = year + "-" + month + "-%";



                      //Query should be "SELECT * FROM `tours` WHERE `date` LIKE 'xxxx-xx-%'"
                      console.log(dbDate);
                      document.getElementById('month').innerHTML=htmlDate;



                      //start end of regular code
                    }
                  });
      
                </script>

              </div>
            <input type = "submit" value = "Submit">
        </form>
    </div>  
</div>


@endsection