@extends('layouts.app')

@section('content')

<div>
    <form method = "GET" action = "{{ route('attendee.index',['id'=>$attendee->token])}}">
        {{ csrf_field() }}
        <h1>Welcome To Floyd Hall: {{ $attendee->firstName }} {{ $attendee->lastName}}</h1>
        <h2>Please Select What Type Of Student You Are</h2>

        
        <label for ="type">Student Type:
        <select name = "type" id = "type">
            @foreach($studentTypes as $sTypes)
                <option value = "{{$sTypes->id}}">{{$sTypes->name}}</option>
            @endforeach
        </select>
        @if($errors->has('status'))
            <span class = "error" >
                <strong>{{$errors->first('status')}}</strong>
            </span>
        @endif
        
        <input type = "submit" value = "Submit">

    </form>
</div>

@endsection