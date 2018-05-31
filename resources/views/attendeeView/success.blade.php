@extends('layouts.app')

@section('content')
<div>
    <h1> Thanks for signing up.</h1>
    <h2> We look forward to seeing you at the tour!</h2>

<div class = "row">
    <div class="small-12 medium-12 columns">
        <div>{{ucfirst($attendee->firstName)}} {{ucfirst($attendee->lastName)}}</div>
        <br>
        <h2>Tour Date and Time</h2>
        <p>{{date('m/d/Y', $tour->date->timestamp)}} {{ Carbon\Carbon::parse($tour->time)->format('h:m A') }}</p>
        
    </div>
    
    <div class="small-12 medium-12 columns">
        <h2>Directions</h2>
        <a href = "https://wmich.edu/engineer/about/directions">Click here</a> for directions to the College
        <br>
    </div>
    
    <div class="small-12 medium-12 columns">
        <br>
        @if(count($links) > 0)
            <h2>News and Other Links About the College</h2>
            <ul>
            @foreach($links as $link)
                <li>{{$link['description']}} <a href="{{$link->link}}">here</a></li>
            @endforeach
            </ul>
        @endif
    </div>

</div>

</div>
@endsection