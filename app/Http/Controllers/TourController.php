<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;

class TourController extends Controller
{
    public function index() {
        return view('admin.tours');
    }

    public function create(Request $request){
      $tour = new Tour();
      $tour->tourtime = $request->get('tourtime');
      $tour->save()->all();
    }
}
