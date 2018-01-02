@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('StudentStatusController@index') }}">Attendees</a></li>
</ul>

<div class="row">
    <div class="small-12 medium-6 column">
    <legend> Student Status</legend>
        <table border = "1" id="majors_table">
        <thead>
            <th>Student Status Name</th>
            <th>New Status Name</th>
        </thead>

        @foreach ($studentStatus as $student_status)
        
        <form method = "POST" action = "{{route('student.status.update',$student_status->id)}}">
            {{ csrf_field() }}
		    {{ method_field('PUT') }}

            <tr>
                <td>
                    {{ $student_status->name }}
                </td>
                <td>
                    <input type = "text" name = "name" value = "" >
                    @if ($errors->first('name'))
                        <small class="error">{{ $errors->first('name') }}</small>
                    @endif
                </td>
                <td>
                    <input class = "button" type = "submit" value = "Save Status">
                </td>
        </form>

        <form method = "POST" action = "{{route('student.status.delete',$student_status->id)}}">
            {{ csrf_field() }}
		    {{ method_field('DELETE') }}
            <td>
              <input class = "button" type = "submit" value = "Delete Status">
            </td>
            </tr>
        </form>

        @endforeach

        <form method = "POST" action = "{{route('student.status.create')}}">
            {{ csrf_field() }}
            <td></td>
            <td>
                <input type = "text" name = "name" value = "" >
                @if ($errors->first('name'))
              <small class="error">{{ $errors->first('name') }}</small>
              @endif
            </td>
            <td>
              <input class = "button" type = "submit" value = "Create New Status">
            </td>
        </table>
    </div>
</div>


@endsection