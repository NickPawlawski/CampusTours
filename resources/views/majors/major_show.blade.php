@extends('layouts.app')

@section('content')
<ul class="breadcrumbs">
	<li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
	<li><a href="{{ route('majors.index') }}">Majors</a></li>
	
</ul>

<div class="row">
	<div class="small-12 columns">
		<h1>Major {{ $major->name }}</h1>
		
	  <form method = "POST" action = "{{ action('MajorsController@update', ['id' => $major->id]) }}">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
    
    <table border="1" id="create_major_table">
      <thead>
        <th width="150"> Info </th>
        <th width="150"> Details </th>
      </thead>
      <tbody>
        <tr>
            <td>
                <label for="Major Name" class="{{ $errors->first('name') ? 'error' : '' }}">Major Name</label>
            </td>
            <td>
                <input type = "text" name = "name" value = "{{$major->name}}" >
                @if ($errors->first('name'))
                <small class="error">{{ $errors->first('name') }}</small>
                @endif
            </td>
        </tr>

        <tr>
            <td>
                <label for="Major Code" class="{{ $errors->first('code') ? 'error' : '' }}">Major Code</label>
            </td>    
            <td>
                <input type = "text" name = "code" value = "{{ $major->code }}">
                @if ($errors->first('code'))
                <small class="error">{{ $errors->first('code') }}</small>
                @endif
            </td>
        </tr>

        <tr>
            <td>
                <label for="Graduate">Graduate</label>
            </td> 
            <td>
                @if($major->graduate)
                    <input type = "checkbox" name = "graduate" checked = "checked">
                @else
                    <input type = "checkbox" name = "graduate" >
                @endif
            </td>
        </tr>

        <tr>
            <td>
            <label for="Undergraduate">Undergraduate</label>
            </td>    
            <td>   
                @if($major->undergraduate)
                    <input type = "checkbox" name = "undergraduate" checked = "checked">
                @else
                    <input type = "checkbox" name = "undergraduate">
                @endif
            </td>
        </tr>
    </tbody>
    </table>

    <input class = "button" type = "submit" value = "Update Major">
</form>



	</div>
</div>

@endsection