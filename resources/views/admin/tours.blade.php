@extends('layouts.app')

@section('content')
  <!-- Filter tours form -->
  <form>
  </form>

  <!-- Add tour form -->
  <form>

  </form>

  <!-- Tours table -->
  <table>
      <thead>
          <th>Tour Time</th>
      </thead>
      <tbody>
          @foreach ($tours as $tour)
            <tr><td>{{ $tour->tourtime->toDateTimeString() }}</td></tr>
          @endforeach
      </tbody>
  </table>
@endsection
