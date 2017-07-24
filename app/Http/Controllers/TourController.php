<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;

use App\Tour;

class TourController extends Controller
{
    public function index() {
        $tours = Tour::orderBy('tourtime', 'desc')->paginate(15);

        return view('admin.tours', [
            'tours' => $tours,
        ]);
    }

    public function create(Request $request){
      $tour = new Tour();
      $tour->tourtime = $request->get('tourtime');
      $tour->save()->all();
    }
}
