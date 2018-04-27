@extends('layouts.app')

@section('content')

<div>
    <form method = "POST" action = "{{ route('attendee.update',['id'=>$attendee->token])}}">
	{{ csrf_field() }}
    <h1>Welcome To Floyd Hall: {{ $attendee->firstName }} {{ $attendee->lastName}}</h1>
	<h2>Please Fill Out the Information Below</h2>

		<label for = "address">
			<p>Address</p>
				<input type = "text" id = "address" name = "address" value = "{{Request::old('address')}}">
			@if($errors->has('address'))
            <span class = "error" >
                <strong>{{$errors->first('address')}}</strong>
            </span>
            @endif
		</label>

		<label for = "city">
			<p>City</p>
				<input type = "text" id = "city" name = "city" value = "{{Request::old('city')}}">
			@if($errors->has('city'))
            <span class = "error" >
                <strong>{{$errors->first('city')}}</strong>
            </span>
            @endif
		</label>

		<label for = "state">
			<p>State</p>
				<input type = "text" id = "state" name = "state" value = "{{Request::old('state')}}">
			@if($errors->has('state'))
            <span class = "error" >
                <strong>{{$errors->first('state')}}</strong>
            </span>
            @endif
		</label>

		<label for = "zip">
			<p>Zip</p>
				<input type = "text" id = "zip" name = "zip" value = "{{Request::old('zip')}}">
			@if($errors->has('zip'))
            <span class = "error" >
                <strong>{{$errors->first('zip')}}</strong>
            </span>
            @endif
		</label>
		
		<label for="term">
		<p>Intended WMU Entry Semester</p>
            <select name = "term" id = "term" value = "other">
                @foreach($terms as $term)
                  <option value = "{{$term->id}}">{{$term->name}}</option>
                @endforeach
            </select>
            @if($errors->has('term'))
            <span class = "error" >
                <strong>{{$errors->first('term')}}</strong>
            </span>
            @endif
          </label>

		@if($attendee->studentType == 2)

		<h3>We would like to know about your schooling so far</h3>
		
		<label for = "hsName">
			<p>High School Name</p>
				<input type = "text" id = "hsName" name = "hsName" value = "{{Request::old('hsName')}}">
			@if($errors->has('term'))
            <span class = "error" >
                <strong>{{$errors->first('term')}}</strong>
            </span>
            @endif
		</label>

		<label for = "hsCity">
			<p>High School City</p>
				<input type = "text" id = "hsCity" name = "hsCity" value = "{{Request::old('hsCity')}}">
			@if($errors->has('term'))
            <span class = "error" >
                <strong>{{$errors->first('term')}}</strong>
            </span>
            @endif
		</label>

		<label for = "hsGpa">
			<p>GPA</p>
				<input type = "text" id = "hsGpa" name = "hsGpa" value = "{{Request::old('hsGpa')}}">
			@if($errors->has('hsGpa'))
            <span class = "error" >
                <strong>{{$errors->first('hsGpa')}}</strong>
            </span>
            @endif
		</label>

		<label for = "act">
			<p>ACT/SAT</p>
				<input type = "text" id = "act" name = "act" value = "{{Request::old('act')}}">
			@if($errors->has('act'))
            <span class = "error" >
                <strong>{{$errors->first('act')}}</strong>
            </span>
            @endif
		</label>

		<label for = "currentGrade">
			<p>Current Grade</p>
				<input type = "text" id = "currentGrade" name = "currentGrade" value = "{{Request::old('currentGrade')}}">
			@if($errors->has('currentGrade'))
            <span class = "error" >
                <strong>{{$errors->first('currentGrade')}}</strong>
            </span>
            @endif
		</label>

		<label for = "earlyCollege">
			<p>Early College Student</p>
				<input type = "checkbox" id = "earlyCollege" name = "earlyCollege" value = "{{Request::old('earlyCollege')}}">
			@if($errors->has('earlyCollege'))
            <span class = "error" >
                <strong>{{$errors->first('earlyCollege')}}</strong>
            </span>
            @endif
		</label>

		@elseif($attendee->studentType == 1)

		<h3>We would like to know about the college you are attending currently</h3>

		<label for = "collegeName">
			<p>Current College Name</p>
				<input type = "text" id = "collegeName" name = "collegeName" value = "{{Request::old('collegeName')}}">
			@if($errors->has('collegeName'))
            <span class = "error" >
                <strong>{{$errors->first('collegeName')}}</strong>
            </span>
            @endif
		</label>

		<label for = "collegeCity">
			<p>City</p>
				<input type = "text" id = "collegeCity" name = "collegeCity" value = "{{Request::old('collegeCity')}}">
			@if($errors->has('collegeCity'))
            <span class = "error" >
                <strong>{{$errors->first('collegeCity')}}</strong>
            </span>
            @endif
		</label>

		<label for = "collegeGpa">
			<p>Current GPA</p>
				<input type = "text" id = "collegeGpa" name = "collegeGpa" value = "{{Request::old('collegeGpa')}}">
			@if($errors->has('collegeGpa'))
            <span class = "error" >
            	<strong>{{$errors->first('collegeGpa')}}</strong>
            </span>
            @endif
		</label>

		@endif

		</br>
		<input class = "button" type = "submit" value = "Save Information">
	</form>
</div>


@endsection