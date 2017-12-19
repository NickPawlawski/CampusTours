@extends('layouts.app')

@section('content')
  <ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('TourController@index') }}">Tours</a></li>
  </ul>
  <div class="row">
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

      <!-- Add tour form -->
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

       <!-- Add multiple tours form -->
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
        <label for="addDateStart" class="{{ $errors->first('addDateStart') ? 'error' : '' }}">Start Date
          <input type="date" id="addDateStart" name="addDateStart" class="{{ $errors->first('addDateStart') ? 'error' : '' }}" value="{{ old('addDateStart') }}"/>
          @if ($errors->first('addDateStart'))
            <small class="error">{{ $errors->first('addDateEnd') }}</small>
          @endif
        </label>
        <label for="addDateEnd" class="{{ $errors->first('addDateEnd') ? 'error' : '' }}">End Date
          <input type = "date" id="addDateEnd" name="addDateEnd" class="{{ $errors->first('addDateEnd') ? 'error' : '' }}" value="{{ old('addDateEnd') }}" />
          @if ($errors->first('addDateEnd'))
            <small class="error">{{ $errors->first('addDateEnd') }}</small>
          @endif
        </label>
        <input class="button" type="submit" value="Delete Tours">
      </fieldset>
    </form>
  </div>

    <!-- Tours table -->
    <div class="small-12 medium-6 column">
      <table>
        <thead>
          <th width="150">
            Tour Date
          </th>
          <th width="150">
            Tour Time
          </th>
          <th width="150">
            Actions
          </th>
        </thead>
        <tbody>
          @foreach ($tours as $tour)
            <tr>
              <td>{{ date('m/d/Y', $tour->date->timestamp) }}</td>
              <td>{{ date('h:i A', strtotime($tour->time)) }}</td>
              <td>
                <form method="POST" action="{{ action('TourController@delete', ['id' => $tour->id]) }}" class="tour_delete">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <a class="button tiny tour_show" href="{{ action('TourController@show', ['id' => $tour->id]) }}">?</a>
                  <input class="button tiny" type="submit" value="X">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <a href="{{ action('TourController@deleted') }}">Restore Deleted Tours</a>

      {{ $tours->appends(['filterDateStart' => $filterDateStart, 'filterDateEnd' => $filterDateEnd])->links() }}
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
