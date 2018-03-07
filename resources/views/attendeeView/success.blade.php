@extends('layouts.app')

@section('content')
<div>
    <h1> Thanks for signing up.</h1>
    <h2> Please arrive the day of your tour. Upon arrival you will<br>
    recieve an email with a link to a page with a couple of questions.
    We look forward to seeing you at the tour!</h2>

    <h3>Attendee:</h3>
    <p>{{$attendee->firstName}}</p>
    <p>{{$attendee->lastName}}</p>
    <h3>Tour:</h3>
    <p>{{date('m/d/Y', $tour->date->timestamp)}}</p>
    <p>{{$tour->time}}</p>

</div>
@endsection