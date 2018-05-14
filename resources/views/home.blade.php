@extends('layouts.app')

@section('content')
    
<div class="row">
	<div class="small-12 columns">
        <h1>Welcome to Floyd Campus Tours</h1>
        <h2>Please fill out the information below. Everything but considerations is required.</h2>
        <form method = "get" action = "{{ route('home.store') }}">
        {{ csrf_field() }}

        <fieldset>
          <legend>Sign up</legend>
          <label for="firstName">First Name
            <input type="text" id="firstName" name="firstName" value = "{{Request::old('firstName')}}"/>
            @if($errors->has('firstName'))
              <span class = "error" >
                <strong>{{$errors->first('firstName')}}</strong>
              </span>
            @endif
          </label>
          
          <label for="lastName">Last Name
            <input type="text" id="lastName" name="lastName" value = "{{Request::old('lastName')}}"/>
            @if($errors->has('lastName'))
              <span class = "error" >
                <strong>{{$errors->first('lastName')}}</strong>
              </span>
            @endif
          </label>

          <label for="email">Email Address
            <input type="text" id="email" name="email" value = "{{Request::old('email')}}"/>
            @if($errors->has('email'))
              <span class = "error" >
                <strong>{{$errors->first('email')}}</strong>
              </span>
            @endif
          </label>

          <label for="phone">Phone Number
            <input type="tel" id="phone" name="phone" value = "{{Request::old('phone')}}"/>
            @if($errors->has('phone'))
              <span class = "error" >
                <strong>{{$errors->first('phone')}}</strong>
              </span>
            @endif
          </label>
          
          <label for="visitors">Number of Visitors
            <input type="text" id="visitors" name="visitors" value = "{{Request::old('visitors')}}"/>
            @if($errors->has('visitors'))
              <span class = "error" >
                <strong>{{$errors->first('visitors')}}</strong>
              </span>
            @endif
          </label>
        
          <label for="major">Major
            <select name = "major" id = "major"  value = "other" value = "{{Request::old('major')}}">
              @foreach($majors as $major)
              @if($major->active == 1)
                <option value = "{{$major->id}}">{{$major->name}}</option>
                @endif
              @endforeach
              @if($errors->has('major'))
              <span class = "error" >
                <strong>{{$errors->first('major')}}</strong>
              </span>
            @endif
            </select>
          </label>

        <label for="considerations">Special Considerations
            <input type="text" id="considerations" name="considerations" value = "{{Request::old('considerations')}}"/>
        </label>
        @if($errors->has('considerations'))
              <span class = "error" >
                <strong>{{$errors->first('considerations')}}</strong>
              </span>
            @endif
        </fieldset>

      
        <input class = "button" type = "submit" value = "Submit Form">
    </form>
      <form method = "GET" action = "{{ route('admin.login') }}">
        <input class = "button" type = "submit" value = "Admin Login">
      </form>
    </div>
</div>


@endsection
