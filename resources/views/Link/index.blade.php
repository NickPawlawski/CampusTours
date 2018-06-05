@extends('layouts.app')

@section('content')



<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ url('admin/link') }}">Links</a></li>
</ul>

<div class = "row">
    <div class="small-12 medium-12 columns">
    <h1>Links Page</h1>
    <h2>Create and Edit Links Here</h2>
    <table>
        <thead>
            <th>Name</th>
            <th>Link</th>
            <th>Description</th>
            <th>Active</th>
            <th>Delete</th>
        </thead>
        <tbody>
        @foreach($links as $link)
            <tr>
                <td>{{$link->name}}</td>
                <td>{{$link->link}}</td>
                <td>{{$link->description}}</td>
                <form method = "get" action = "{{ route('change.active', ['id' => $link->id])}}">
                {{ csrf_field() }}
                    <td>
                    @if($link->active)
                        <input class = "button" type = "submit" value = "Make Inactive">
                    @else
                        <input class = "button" style = "background-color:red;" type = "submit" value = "Make Active">
                    @endif

                    </td>
                </form>
                <form method = "get" action = "{{ route('delete.link', ['id' => $link->id])}}">
                    
                    {{ csrf_field() }}
                    <td><input class = "button" style = "background-color:red;" type = "submit" value = "Delete Link"></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="small-12 medium-12 columns">
        <fieldset>
        <legend>Create New Link</legend>
            <form method = "post" action="{{route('add.link')}}">
            {{ csrf_field() }}
                
                <label for = "name">Name:</label>
                <input type = "text" name = "name" id = "name">
                @if ($errors->first('name'))
                    <small class="error">{{ $errors->first('name') }}</small>
                @endif 

                <label for = "link">Link:</label>
                <input type = "text" name = "link" id = "link">
                @if ($errors->first('link'))
                    <small class="error">{{ $errors->first('link') }}</small>
                @endif 

                <label for = "description">Description:</label>
                <input type = "text" name = "description" id = "description">
                @if ($errors->first('description'))
                    <small class="error">{{ $errors->first('description') }}</small>
                @endif 

                <input class = "button" type = "submit" value = "Add Link">
            </form>
        </fieldset>
    </div>

</div>

@endsection