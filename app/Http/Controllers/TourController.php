<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index() {
        $tours = Tour::orderBy('tourtime', 'desc')->paginate(15);

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
        $tour->tourtime = new Carbon($request->get('addDate') . ' ' . $request->get('addTime'));
        $tour->save();

        // Redirect to the main tours panel
        return redirect()->action('TourController@index');
    }
}
