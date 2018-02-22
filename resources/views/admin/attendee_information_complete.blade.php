@extends('layouts.app')

@section('content')

{{ csrf_field() }}
        <h1>Thank you: {{ $attendee->firstName }} {{ $attendee->lastName}}</h1>
        <h2>Your Registration is complete!</h2>

@endsection