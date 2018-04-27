@extends('layouts.app')

@section('content')

<div>

    <h1>Manage Active Majors</h1>

    <table border = "1">
        <thead>
            <th width="150">Major Name</th>
            <th width="150">Code</th>
            <th width="150">Graduate</th>
            <th width="150">Undergraduate</th>
        </thead>

        <tbody>
        @foreach($majors as $major)
            @if($major->active == 0)
            <tr>
            <td>{{ $major->name }}</td>
            <td>{{ $major->code }}</td>	

            <td>
                @if($major->graduate)
                Yes
                @else
                No
                @endif
                </td>
            
            <td> 
                @if($major->undergraduate)
                Yes
                @else
                No
                @endif   
            </td>
            
            <td>
                <form method="POST" action = "{{ action('MajorsController@make_visible') }}"> 
                {{ csrf_field() }}
                <input type = "hidden" name = "id" value = "{{$major->id}}">
                
                @if($major->active == 1)
                    <input class = "button" type = "submit" value = "Make Inactive">
                @else
                    <input class = "button" type = "submit" value = "Make Active">
                @endif
                </form>
                <td>    
                    <form method = "GET" action = "{{ action('MajorsController@show',['id'=>$major->id])}}">
                        <input class = "button" type = "submit" value = "Update Major">
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>


    </table>

</div>


@endsection