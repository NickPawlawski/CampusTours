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
          <th>Date</th>
          <th>Time</th>
      </thead>
      @foreach ($tours as $tour)
          
      @endforeach
  </table>
@endsection
