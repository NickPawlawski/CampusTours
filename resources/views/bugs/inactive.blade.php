@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ url('admin/bugs') }}">Bug Reporter</a></li>
    <li class = "current"><a href = "{{action('BugsController@old')}}">Squashed Bugs</a></li>
	
</ul>
<div>
    <h3>Squashed Bugs</h3>
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
                    {{csrf_field()}}
                        <input class = 'button' type = 'submit' value = 'View Details'>
                    </form>
                </td>
            </tr>
                
            @endforeach
        @else
            <p>There are no bugs to show</p>
		@endif

        </table>

        

    </fieldset>
</div>


@endsection