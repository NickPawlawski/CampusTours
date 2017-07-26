@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="small-12 medium-6 column">
      <!-- Filter tours form -->
      <form>
        <fieldset>
          <legend>Filter Tours</legend>
          {{ csrf_field() }}
          <label for="filterDate">By Date
            <input type="date" id="filterDate" name="filterDate"/>
          </label>
          <input class="button" type="submit" value="Filter">
        </fieldset>
      </form>

      <!-- Add tour form -->
      <form method="POST" action="{{ action('TourController@create') }}">
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

    <!-- Tours table -->
    <div class="small-12 medium-6 column">
      <table>
        <thead>
          <th width="150">Tour Date</th>
          <th width="150">Tour Time</th>
          <th width="150">Actions</th>
        </thead>
        <tbody>
          @foreach ($tours as $tour)
            <tr>
              <td>{{ date('m/d/Y', $tour->date->timestamp) }}</td>
              <td>{{ date('h:i A', strtotime($tour->time)) }}</td>
              <td>
                <form method="POST" action="{{ action('TourController@delete', ['id' => $tour->id]) }}">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <a class="button tiny" href="{{ action('TourController@show', ['id' => $tour->id]) }}">?</a>
                  <input class="button tiny" type="submit" value="X">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <a href="{{ action('TourController@deleted') }}">Restore Deleted Tours</a>

      {{ $tours->links() }}
    </div>
  </div>
@endsection
