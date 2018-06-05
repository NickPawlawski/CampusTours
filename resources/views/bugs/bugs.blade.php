@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li class = "current"><a href="{{ url('admin/bugs') }}">Bug Reporter</a></li>
	
</ul>
<div>
    <h1>Bug Reporter</h1>
    <h3>Report a Bug</h3>
    <fieldset>	
        <form method = "POST" action = "{{ route('add.bug') }}"> 
            {{csrf_field()}}
            <label for = "bugName" >Bug Name</label>
            <input type = 'text' name = 'bugName'>
            <label for = "page" >Bug Location</label>
            <select name = "page">
                @foreach($pages as $page)
                    <option value = "{{ $page->id}}">{{$page->name}}</option>
                @endforeach
            </select>
            <label for = "bugDescription" >Bug Description</label>
            <textarea rows = "5" cols = "50"  name = 'bugDescription'></textarea>
            <input class = "button" type = 'submit'>
        </form>
    </fieldset>

    <h3>Reported Bugs</h3>
    <fieldset>
    <table border = "1" id = "date_table">
        @if(count($bugs) > 0)
			<thead>
				<th>Bug Id</th>
				<th>Bug Name</th>
				<th>Bug Page</th>
                <th>Status</th>
			</thead>
            @foreach($bugs as $bug)
                
                <tr>
                    <td>{{ $bug->id}}</td>
                    <td>{{ $bug->name}}</td>
                    <td>{{ $pages[$bug->page-1]->name }}</td>
                    <td>{{ $bugStatus[$bug->status-1]->name}}</td>
                    <td>
                        <form method = 'get' action = "{{route('bug.show',['id'=>$bug->id])}}">
                            <input class = 'button' type = 'submit' value = 'View Details'>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        @else
            <p>There are no bugs to show</p>
		@endif
        </table>

        <form method = 'get' action = "{{action('BugsController@old')}}">
        
            <input class = "button" type = 'submit' value = 'Show Squashed Bugs'>
        </form>

    </fieldset>
</div>


@endsection