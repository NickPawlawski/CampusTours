@extends('layouts.app')

@section('content')

<ul class="breadcrumbs">
    <li><a href="{{ action('HomeController@admin') }}">Admin</a></li>
    <li class="current"><a href="{{ action('TourController@index') }}">Majors</a></li>
  </ul>


<div class="row">
  <div class="small-12 medium-6 column">
    <legend> Majors Admin</legend>
      <table border = "1" id="majors_table">
      <thead>
          <th width="150">
            Code
          </th>
          <th width="150">
            Major Name
          </th>
          <th width="150">
            Graduate
          </th>
          <th width="150">
            Undergraduate
          </th>
        </thead>
        <tbody>
        @foreach ($majors as $major)
        <tr>
           <td>{{ $major->code }}</td>	
           <td>{{ $major->name }}</td>
           
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

            <td>    
                <form method = "POST" action = "{{ route('major.destroy',['id'=>$major->id])}}">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                    <input class = "button" type = "submit" value = "Delete Major">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <legend> Add Major </legend>
    <form method = "POST" action = "{{ action('MajorsController@store') }}">
    {{ csrf_field() }}
    
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
                <input type = "text" name = "name">
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
                <input type = "text" name = "code">
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
                <input type = "checkbox" name = "graduate">
            </td>
        </tr>

        <tr>
            <td>
            <label for="Undergraduate">Undergraduate</label>
            </td>    
            <td>    
                <input type = "checkbox" name = "undergraduate">
            </td>
        </tr>
    </tbody>
    </table>

    <input class = "button" type = "submit" value = "Create Major">
</form>

</div>
</div>
@endsection