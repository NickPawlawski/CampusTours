@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('StudentStatusController@index') }}">Attendees</a></li>
</ul>

<div class="row">
    <div class="small-12 medium-6 column">
    <h1> Student Status</h1>
        <table border = "1" id="majors_table">
        <thead>
            <th >Student Status Name</th>
            <th >New Status Name</th>
            <th >Update Status</th>
            <th >Delete Status</th>
        </thead>

        @foreach ($studentStatus as $student_status)
        
        <form method = "POST" action = "{{route('student.status.update',$student_status->id)}}">
            {{ csrf_field() }}
		    {{ method_field('PUT') }}

        @if($student_status->name == "N/A")
        <tr>
            <td>{{ "Deleted Status"}}</td>
            <td>{{ $student_status->old_name }}</td>
            <td><input style = "background-color:blue;" class = "button" type = "submit" value = "Restore Status"></td>
        </tr>
        @else
            <tr>
                <td>{{ $student_status->name }}</td>
                <td>
                    <input type = "text" name = "name" value = "">
                    @if ($errors->first('name'))
                        <small class="error">{{ $errors->first('name') }}</small>
                    @endif
                </td>
                <td>
                    <input class = "button" type = "submit" value = "Update Status">
                </td>
        </form>
        

        <form method = "POST" action = "{{route('student.status.delete',$student_status->id)}}">
            {{ csrf_field() }}
		    {{ method_field('DELETE') }}
            <td>
              <input class = "button alert" type = "submit" value = "Delete Status">
            </td>
            </tr>
        </form>
        @endif
        @endforeach

        
        </table>
        <fieldset>
        <form method = "POST" action = "{{route('student.status.create')}}">
            {{ csrf_field() }}
            <label for = "name">Create New Status:</label>
            <input type = "text" name = "name" value = "" >
            @if ($errors->first('name'))
                <small class="error">{{ $errors->first('name') }}</small>
            @endif
        
            <input class = "button" type = "submit" value = "Create New Status">
            
        </form>
        </fieldset>
    </div>
</div>


@endsection