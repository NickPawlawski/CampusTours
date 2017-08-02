<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use Carbon\Carbon;

class TourController extends Controller
{
    /* Shows a view containing a list of tours, along with
       forms for adding and filtering them. */
    public function index(Request $request) {
        $this->validate($request, [
                'filterDateStart' => 'date_or_empty',
                'filterDateEnd' => 'date_or_empty',
            ]);

        $toursQuery = Tour::query();

        if ($request->has('filterDateStart') && !empty($request->get('filterDateStart'))) {
            $toursQuery = $toursQuery->where('date', '>=', $request->get('filterDateStart'));
        }

        if ($request->has('filterDateEnd') && !empty($request->get('filterDateEnd'))) {
            $toursQuery = $toursQuery->where('date', '<=', $request->get('filterDateEnd'));
        }

        // Finish the query by sorting and paginating.
        $tours = $toursQuery
            ->orderBy('time', 'desc')
            ->orderBy('date', 'desc')
            ->paginate(15);

        // Return the tours view.
        return view('admin.tours', [
            'tours' => $tours,
        ]);
    }

    /* Takes information about a new tour and creates it in the database. */
    public function create(Request $request){
        // Validate the new date and time.
        $this->validate($request, [
                'addDate' => 'required|date_format:Y-m-d',
                'addTime' => 'required|date_format:H:i'
            ]);

        // Create the new tour.
        $tour = new Tour();
        // The date will be in the form of a Carbon object.
        $tour->date = new Carbon($request->get('addDate'));
        // The time will be a properly formatted string.
        $tour->time = date('H:i:s', strtotime($request->get('addTime')));
        $tour->save();

        // Redirect to the main tours panel.
        return redirect()->action('TourController@index');
    }

    /* Displays information about a tour. */
    public function show(Request $request, $id)
    {
        $tour = Tour::find($id);

        return view('admin.tours_show', [
            'tour' => $tour
        ]);   
    }

    /* Deletes a tour. */
    public function delete(Request $request)
    {
        Tour::find($request->id)->delete();

        return redirect()->action('TourController@index');
    }

    /* Displays deleted tours and allows them to be restored. */
    public function deleted(Request $request)
    {
        $tours = Tour::onlyTrashed()->get();

        return view('admin.tours_deleted', [
                'tours' => $tours
            ]);
    }

    /* Restores a tour from deletion. */
    public function restore(Request $request, $id)
    {
        $tour = Tour::withTrashed()->find($id);

        $tour->restore();

        return redirect()->back();
    }
}
