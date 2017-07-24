@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="small-12 medium-6 column">
      <!-- Filter tours form -->
      <form>
        <label for="filterDate">Filter Tours by Date
          <input type="date" id="filterDate" name="filterDate"/>
        </label>
      </form>

      <!-- Add tour form -->
      <form>
        <label for="addDate">Add Tour
          <input type="date" id="filterDate" name="filterDate"/>
          <input type="time" id="filterTime" name="filterTime"/>
        </label>
      </form>
    </div>

    <!-- Tours table -->
    <div class="small-12 medium-6 column">
      <table>
        <thead>
          <th width="200">Tour Time</th>
          <th width="150">Actions</th>
        </thead>
        <tbody>
          @foreach ($tours as $tour)
            <tr>
              <td>{{ $tour->tourtime->toDateTimeString() }}</td>
              <td>(action buttons)</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $tours->links() }}
    </div>
  </div>
@endsection
