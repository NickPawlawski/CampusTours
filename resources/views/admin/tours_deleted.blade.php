@extends('layouts.app')

@section('content')

<div class="row">
	<div class="small-12 columns">
		<table>
			<thead>
				<th size="150">Tour Date</th>
				<th size="150">Tour Time</th>
				<th size="150">Actions</th>
			</thead>
			<tbody>
				@foreach ($tours as $tour)
					<tr>
						<td>{{ date('m/d/Y', $tour->date->timestamp) }}</td>
              			<td>{{ date('h:i A', strtotime($tour->time)) }}</td>
              			<td>
              				<form method="POST" action="{{ action('TourController@restore', ['id' => $tour->id]) }}">
              					{{ csrf_field() }}
              					<input class="button tiny" type="submit" value="Restore">
              				</form>
              			</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection