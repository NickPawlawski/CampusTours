@extends('layouts.app')

@section('content')
    
<div class="row">
	<div class="small-12 columns">
        <h1>Hello</h1>
        <form method = "POST" action = "{{ route('home.store') }}">
        {{ csrf_field() }}

        <fieldset>
          <legend>Sign up</legend>
          <label for="firstName">First Name
            <input type="text" id="firstName" name="firstName" />
            @if($errors->has('firstName'))
              <span class = "error" >
                <strong>{{$errors->first('firstName')}}</strong>
              </span>
            @endif
          </label>
          <label for="lastName">Last Name
            <input type="text" id="lastName" name="lastName" />
            @if($errors->has('lastName'))
              <span class = "error" >
                <strong>{{$errors->first('lastName')}}</strong>
              </span>
            @endif
          </label>

          <label for="email">Email Address
            <input type="text" id="email" name="email" />
            @if($errors->has('email'))
              <span class = "error" >
                <strong>{{$errors->first('email')}}</strong>
              </span>
            @endif
          </label>

          <label for="phone">Phone Number
            <input type="tel" id="phone" name="phone" />
            @if($errors->has('phone'))
              <span class = "error" >
                <strong>{{$errors->first('phone')}}</strong>
              </span>
            @endif
          </label>

          <label for="status">Type
            <select name = "status" id = "hall" value = "other">
                @foreach($statuses as $status)
                  <option value = "{{$status->id}}">{{$status->name}}</option>
                @endforeach
            </select>
            @if($errors->has('status'))
              <span class = "error" >
                <strong>{{$errors->first('status')}}</strong>
              </span>
            @endif
          </label>
          
          <label for="visitors">Number of Visitors
            <input type="text" id="visitors" name="visitors" />
            @if($errors->has('visitors'))
              <span class = "error" >
                <strong>{{$errors->first('visitors')}}</strong>
              </span>
            @endif
          </label>
        
          <label for="major">Major
            <select name = "major" id = "hall"  value = "other">
              @foreach($majors as $major)
                <option value = "{{$major->id}}">{{$major->name}}</option>
              @endforeach
              @if($errors->has('major'))
              <span class = "error" >
                <strong>{{$errors->first('major')}}</strong>
              </span>
            @endif
            </select>
          </label>

        <label for="considerations">Special Considerations
            <input type="text" id="considerations" name="considerations"/>
        </label>
        @if($errors->has('considerations'))
              <span class = "error" >
                <strong>{{$errors->first('considerations')}}</strong>
              </span>
            @endif
        </fieldset>

        <fieldset>

            <legend>Tour Selector</legend>
            <select name = "tours">
            @foreach($tours as $tour)
                <option value = "{{$tour->id}}">{{date('Y-m-d', strtotime($tour->date))}}</option>
            @endforeach 
            @if($errors->has('tours'))
              <span class = "error" >
                <strong>{{$errors->first('tours')}}</strong>
              </span>
            @endif
            </select>

        </fieldset>         

        <input class = "button" type = "submit" value = "Submit Form">
    </form>
    </div>
</div>


@endsection
