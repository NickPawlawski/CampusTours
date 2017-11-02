@extends('layouts.app')

@section('content')
    
<div class="row">
	<div class="small-12 columns">
        <h1>Hello</h1>
        <form method = "POST" action = "{{ action('HomeController@store') }}">
        {{ csrf_field() }}

        <fieldset>
          <legend>Sign up</legend>
          <label for="firstName">First Name
            <input type="text" id="firstName" name="firstName" />
          </label>
          <label for="lastName">Last Name
            <input type="text" id="lastName" name="lastName" />
          </label>

          <label for="email">Email Address
            <input type="text" id="email" name="email" />
          </label>

          <label for="email">Confirm Email Addfress
            <input type="text" id="confirm_email" name="confirm_email">
          </label>

          <label for="phone">Phone Number
            <input type="phone" id="phone" name="phone" />
          </label>

          <label for="studentType">Type
            <select name = "studentType" id = "hall" value = "other">
                <option value = "other">Other</option>
                <option value = "transfer">Transfer</option>
                <option value = "freshman">Freshman</option>
                <option value = "graduate">Graduate</option>
            </select>
          </label>
          
          <label for="visitors">Number of Visitors
            <input type="text" id="visitors" name="visitors" />
          </label>
        
          <label for="major">Major
            <select name = "major" id = "hall" multiple = "multiple" value = "other">
          @foreach($majors as $major)
            <option value = "{{$major->id}}">{{$major->name}}</option>
          @endforeach
        </select>

        <label for="considerations">Special Considerations
            <input type="text" id="considerations" name="considerations"/>
        </label>
        </fieldset>

        <fieldset>

            <legend>Tour Selector</legend>
            <select name = "tours">
            @foreach($tours as $tour)
                <option value = "{{$tour->id}}">{{date('Y-m-d', strtotime($tour->date))}}</option>
            @endforeach 
            </select>

        </fieldset>         

        <input class = "button" type = "submit" value = "Submit Form">
    </form>
    </div>
</div>


@endsection
