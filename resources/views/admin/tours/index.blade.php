@extends('layouts.app')

@section('content')

  <ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('TourController@index') }}">Tours</a></li>
  </ul>
  <div class="row">
    @if(count($todayTours) > 0)
    <div class = "small-12 medium-12 column">
      <fieldset>
      <legend>Today's Tours for {{Carbon\Carbon::now()->format('d-m-Y')}}</legend>
      <div class="small-12 medium-12 column">
      <table>
        <thead>
          <th width="150">Tour Time</th>
          <th width="150">Visitors</th>
          <th width="150">Attendees</th>
          <th width="150">Actions</th>
        </thead>
        <tbody>
          @for ($x = 0; $x < count($todayTours); $x++)
            <tr>
              <td>{{ date('h:i A', strtotime($todayTours[$x]->time)) }}</td>
              <td>{{ $todayToursAttendee[$x]}}</td>
              <td>{{ $todayToursVisitor[$x]}}</td>
              <td>
                <form method="POST" action="{{ action('TourController@delete', ['id' => $tours[$x]->id]) }}" class="tour_delete">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <a class="button tiny tour_show" href="{{ action('TourController@show', ['id' => $tours[$x]->id]) }}">?</a>
                  <input class="button tiny" type="submit" value="X">
                </form>
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
    </div>
    @endif
 

    <div class="small-12 medium-6 column">
      <!-- Filter tours form -->
      <form method="GET" action="{{ action('TourController@index') }}">
        <fieldset>
          <legend>Filter Tours</legend>
          <label for="filterDateStart">Start Date
            <input type="date" id="filterDateStart" name="filterDateStart" value="{{ $filterDateStart }}"/>
          </label>
          <label for="filterDateEnd">End Date
            <input type="date" id="filterDateEnd" name="filterDateEnd" value="{{ $filterDateEnd }}"/>
          </label>
          <input class="button" type="submit" value="Filter">
          <a href="{{ action('TourController@index') }}" class="button alert">Clear Filter</a>
        </fieldset>
      </form>
    </div>
      <!-- Add tour form -->
    <div class="small-12 medium-6 column">
      <form method="POST" action="{{ action('TourController@store') }}">
        <fieldset>
          <legend>Add Tour</legend>
          {{ csrf_field() }}
          <label for="addDate" class="{{ $errors->first('addDate') ? 'error' : '' }}">Date
            <input type="date" id="addDate" name="addDate" class="{{ $errors->first('addDate') ? 'error' : '' }}" value="{{ old('addDate') }}"/>
            @if ($errors->first('addDate'))
              <small class="error">{{ $errors->first('addDate') }}</small>
            @endif
          </label>
          <label for="addTime" class="{{ $errors->first('addTime') ? 'error' : '' }}">Time
            <input type="time" id="addTime" name="addTime" class="{{ $errors->first('addTime') ? 'error' : '' }}" value="{{ old('addTime') }}"/>
            @if ($errors->first('addTime'))
              <small class="error">{{ $errors->first('addTime') }}</small>
            @endif
          </label>
          <input class="button" type="submit" value="Add Tour">
        </fieldset>
      </form>
    </div>

       <!-- Add multiple tours form -->
       <div class="small-12 medium-6 column">
      <form method="POST" action="{{ action('TourController@storeMultiple') }}">
        <fieldset>
          <legend>Add Multiple Tours</legend>
          @if (session('addMultipleWarning'))
            <div class="warning">
              {{ session('addMultipleWarning') }}
            </div>
          @endif
          @if (session('addMultipleStatus'))
            <div class="success">
              {{ session('addMultipleStatus') }}
            </div>
          @endif
          {{ csrf_field() }}
          <label for="addDateStart" class="{{ $errors->first('addDateStart') ? 'error' : '' }}">Start Date
            <input type="date" id="addDateStart" name="addDateStart" class="{{ $errors->first('addDateStart') ? 'error' : '' }}" value="{{ old('addDateStart') }}"/>
            @if ($errors->first('addDateStart'))
              <small class="error">{{ $errors->first('addDateStart') }}</small>
            @endif
          </label>
          <label for="addDateEnd" class="{{ $errors->first('addDateEnd') ? 'error' : '' }}">End Date
            <input type="date" id="addDateEnd" name="addDateEnd" class="{{ $errors->first('addDateEnd') ? 'error' : '' }}" value="{{ old('addDateEnd') }}"/>
            @if ($errors->first('addDateEnd'))
              <small class="error">{{ $errors->first('addDateEnd') }}</small>
            @endif
          </label>
          <label for="addTimeMultiple" class="{{ $errors->first('addTimeMultiple') ? 'error' : '' }}">Tour Time
            <input type="time" id="addTimeMultiple" name="addTimeMultiple" class="{{ $errors->first('addTimeMultiple') }}" value="{{ old('addTimeMultiple') }}"/>
            @if ($errors->first('addTimeMultiple'))
              <small class="error">{{ $errors->first('addTimeMultiple') }}</small>
            @endif
          </label>
          <table>
            <thead>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </thead>
            <tbody>
              <tr>
                <td><input id="addDateMonday" name="addDayOfWeek[]" value="1" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
                <td><input id="addDateTuesday" name="addDayOfWeek[]" value="2" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
                <td><input id="addDateWednesday" name="addDayOfWeek[]" value="3" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
                <td><input id="addDateThursday" name="addDayOfWeek[]" value="4" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
                <td><input id="addDateFriday" name="addDayOfWeek[]" value="5" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
                <td><input id="addDateSaturday" name="addDayOfWeek[]" value="6" type="checkbox" class="{{ $errors->first('addDateCheckbox') }}"></td>
              </tr>
            </tbody>
          </table>
          @if($errors->first('addDateCheckbox'))
            <small class="error">{{ $errors->first('addDateCheckbox') }}</small>
          @endif
          <input class="button" type="submit" value="Add Tours">
        </fieldset>
      </form>
      </div>
    

    <!-- Delete Multiple tours form -->
    <div class="small-12 medium-6 column">
    <form method="POST" action="{{ action('TourController@deleteMultiple') }}">
      {{ method_field('DELETE') }}
      <fieldset>
        <legend>Delete Multiple Tours</legend>
        @if (session('deleteMultipleWarning'))
          <div class="warning">
            {{ session('deleteMultipleWarning') }}
          </div>
        @endif
        @if (session('deleteMultipleStatus'))
          <div class="success">
            {{ session('deleteMultipleStatus') }}
          </div>
        @endif
        {{ csrf_field() }}
        <label for="deleteDateStart" class="{{ $errors->first('deleteDateStart') ? 'error' : '' }}">Start Date
          <input type="date" id="deleteDateStart" name="deleteDateStart" class="{{ $errors->first('deleteDateStart') ? 'error' : '' }}" value="{{ old('addDateStart') }}"/>
          @if ($errors->first('deleteDateStart'))
            <small class="error">{{ $errors->first('deleteDateStart') }}</small>
          @endif
        </label>
        <label for="deleteDateEnd" class="{{ $errors->first('deleteDateEnd') ? 'error' : '' }}">End Date
          <input type = "date" id="deleteDateEnd" name="deleteDateEnd" class="{{ $errors->first('deleteDateEnd') ? 'error' : '' }}" value="{{ old('addDateEnd') }}" />
          @if ($errors->first('deleteDateEnd'))
            <small class="error">{{ $errors->first('deleteDateEnd') }}</small>
          @endif
        </label>
        <input class="button" type="submit" value="Delete Tours">
      </fieldset>
    </form>
    </div>
  

    <!-- Tours table -->
    <div class="small-12 medium-12 column">
    <fieldset>
      <legend>Upcoming Tours</legend>
      <div class="small-12 medium-12 column">
      <table>
        <thead>
          <th width="150">Tour Date</th>
          <th width="150">Tour Time</th>
          <th width="150">Visitors</th>
          <th width="150">Attendees</th>
          <th width="150">Actions</th>
        </thead>
        <tbody>
          @for ($x = 0; $x < $tours->count(); $x++)
            <tr>
              <td>{{ date('m/d/Y', $tours[$x]->date->timestamp) }}</td>
              <td>{{ date('h:i A', strtotime($tours[$x]->time)) }}</td>
              <td>{{ $visitorTotal[$x]}}</td>
              <td>{{ $attendeeTotal[$x]}}</td>
              <td>
                <form method="POST" action="{{ action('TourController@delete', ['id' => $tours[$x]->id]) }}" class="tour_delete">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <a class="button tiny tour_show" href="{{ action('TourController@show', ['id' => $tours[$x]->id]) }}">?</a>
                  <input class="button tiny" type="submit" value="X">
                </form>
              </td>
            </tr>
          @endfor
        </tbody>
      </table>

      <a href="{{ action('TourController@deleted') }}">Restore Deleted Tours</a>

      {{ $tours->appends(['filterDateStart' => $filterDateStart, 'filterDateEnd' => $filterDateEnd])->links() }}

      </div>
    </fieldset>
  </div>
</div>
  <script>
    /*$("#filterDateStart").on("blur", function() {
      // If the start date is specified but the end date isn't, make them match.
      if ($("#filterDateStart").val() !== '' && $("#filterDateEnd").val() === '') {
        // Make the end date match the start.
        $("#filterDateEnd").val($("#filterDateStart").val());
      }
    });*/

    $(".tour_delete").on("submit", function() {
      return confirm("Delete this tour?");
    });
  </script>
@endsection
