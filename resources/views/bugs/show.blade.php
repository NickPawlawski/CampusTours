@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ url('admin/bugs') }}">Bug Reporter</a></li>
    
	
</ul>
<div>
    <h1>Bug Reporter</h1>
    
    <fieldset>
		<legend>Bug {{$bug->id}}</legend>
        <table >
		<thead>
           
        </thead>
		<tr>
            <td>Bug Name:</td>
            <td>{{ $bug->name }}</td>
        </tr>
        <tr>
            <td>Bug Description:</td>
            <td>{{ $bug->description }}</td>
        </tr>
        <tr>
            <td>Bug Page:</td>
            <td>{{ $pages[$bug->page-1]->name }}</td>
        </tr>
        <tr>
            <td>Bug Activity:</td>
            <td>
                @if($bug->active)
                 Yes 
                @else
                 No
                @endif
            </td>
        </tr>
        </table>

        </fieldset>
        <form method = 'post' action = "{{route('bug.update',['id'=>$bug->id])}}">
        {{csrf_field()}}
        <fieldset>
        <table>
        <tr>
            <td>Bug Status:</td>
            <td>
                <select name = 'status'>
                    
                    @foreach($bugStatus as $status)
                    
                        @if($status->id == $bug->status)
                            <option selected = 'selected' value = "{{$status->id}}">{{$status->name}}</option>
                        @else
                            <option value = "{{$status->id}}">{{$status->name}}</option>
                        @endif
                     
                    @endforeach
                   
                </select>
            </td>
        </tr>
        </table>

		<input class = "button" type = "submit" value = "Update Information">
		</fieldset>
        </form>

</div>


@endsection