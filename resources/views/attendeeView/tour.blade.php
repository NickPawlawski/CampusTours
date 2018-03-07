@extends('layouts.app')

@section('content')
<div class="row">
	<div class="small-12 columns">
            <h1>Please select the tour you would like to Attend.</h1>
            <h2>If you would like to change months, use the back button in your browser</h2>
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Time</th>
                    </thead>

                    <tbody>
                        @foreach($tours as $tour)
                        <tr>
                            <td>{{ date('m/d/Y', $tour->date->timestamp)  }}</td>
                            <td>{{ $tour->time  }}</td>
                            <td>
                                <form method = "POST" action = "{{action('HomeController@saveTour',['id'=>$tour->id])}}">
                                {{ csrf_field() }}
                                    <input class = "button" type = "submit" value = "Attend This Tour">
                                    <input type = "hidden" name = "token" value = "{{ $token }}">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
    </div>  
</div>


@endsection