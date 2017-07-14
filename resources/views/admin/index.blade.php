@extends('layouts.app')

@section('content')
  You are logged in!<br/>
  <a href="{{ url('admin/tours') }}">Tours</a>
@endsection
