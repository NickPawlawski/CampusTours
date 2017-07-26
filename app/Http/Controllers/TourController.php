<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index(Request $request) {
        $toursQuery = Tour::query();

        if ($request->has('filterDate')) {
            $toursQuery = $toursQuery->where('date', '=', $request->get('filterDate'));
        }

        $tours = $toursQuery
            ->orderBy('time', 'desc')
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('admin.tours', [
            'tours' => $tours,
        ]);
    }

    public function create(Request $request){
        // Validate
        $this->validate($request, [
                'addDate' => 'required|date_format:Y-m-d',
                'addTime' => 'required|date_format:H:i'
            ]);

        // Create the new tour
        $tour = new Tour();
        $tour->date = new Carbon($request->get('addDate'));
        $tour->time = date('H:i:s', strtotime($request->get('addTime')));
        $tour->save();

        // Redirect to the main tours panel
        return redirect()->action('TourController@index');
    }

    public function show(Request $request)
    {
        $tour = Tour::find($request->id);

        return view('admin.tours_show', [
            'tour' => $tour
        ]);   
    }
}
