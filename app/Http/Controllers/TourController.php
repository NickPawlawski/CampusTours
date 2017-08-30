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
        // Validate the start and end date inputs.
        $this->validate($request, [
                'filterDateStart' => 'date_or_empty',
                'filterDateEnd' => 'date_or_empty',
            ]);

        // Set a default start and end date for queries.
        $filterDateStart = $request->get('filterDateStart', date('Y-m-d'));
        $filterDateEnd = $request->get('filterDateEnd', date('Y-m-d', strtotime('+3 months')));

        // Ensure that the start date is before the end date.
        if (strtotime($filterDateStart) > strtotime($filterDateEnd)) {
            $temp = $filterDateStart;
            $filterDateStart = $filterDateEnd;
            $filterDateEnd = $temp;
        }

        // Build a query including the start and end date, and ordering.
        $tours = Tour::whereBetween('date', [$filterDateStart, $filterDateEnd])
            ->orderBy('time', 'desc')
            ->orderBy('date', 'desc')
            ->paginate(15);

        // Return the tours view.
        return view('admin.tours.index', [
            'tours' => $tours,
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd,
        ]);
    }

    /* Takes information about a new tour and creates it in the database. */
    public function store(Request $request){
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

    public function storeMultiple(Request $request)
    {
        // Validate the dates and time.
        $this->validate($request, [
                'addDateStart' => 'required|date_format:Y-m-d',
                'addDateEnd' => 'required|date_format:Y-m-d',
                'addTimeMultiple' => 'required|date_format:H:i',
                'addDateMonday' => 'boolean|required_without_all:addDateTuesday,addDateWednesday,addDateThursday,addDateFriday,addDateSaturday',
                'addDateTuesday' => 'boolean|required_without_all:addDateMonday,addDateWednesday,addDateThursday,addDateFriday,addDateSaturday',
                'addDateWednesday' => 'boolean|required_without_all:addDateMonday,addDateTuesday,addDateThursday,addDateFriday,addDateSaturday',
                'addDateThursday' => 'boolean|required_without_all:addDateMonday,addDateTuesday,addDateWednesday,addDateFriday,addDateSaturday',
                'addDateFriday' => 'boolean|required_without_all:addDateMonday,addDateTuesday,addDateWednesday,addDateThursday,addDateSaturday',
                'addDateSaturday' => 'boolean|required_without_all:addDateMonday,addDateTuesday,addDateWednesday,addDateThursday,addDateFriday',
            ]);

        $startDate = new Carbon($request->get('addDateStart'));
        $endDate = new Carbon($request->get('addDateEnd'));

        // Ensure that the end date is 6 months after the start or sooner.
        if ($startDate->copy()->addMonths(6)->lt($endDate)) {
            $endDate = $startDate->copy()->addMonths(6);
        }

        // Verify that the start date is before the end date.
        if ($startDate->lte($endDate)) {
            // Current date to create a new instance of a tour with.
            $currentDate = new Carbon($request->get('addDateStart'));

            // Repeat adding a tour, following the repetition pattern, until we
            // reach the end date.
            do {
                if ($currentDate->dayOfWeek == 1 && $request->get('addDateMonday')
                        || $currentDate->dayOfWeek == 2 && $request->get('addDateTuesday')
                        || $currentDate->dayOfWeek == 3 && $request->get('addDateWednesday')
                        || $currentDate->dayOfWeek == 4 && $request->get('addDateThursday')
                        || $currentDate->dayOfWeek == 5 && $request->get('addDateFriday')
                        || $currentDate->dayOfWeek == 6 && $request->get('addDateSaturday')) {
                    $tour = new Tour();
                    $tour->date = $currentDate->copy();
                    $tour->time = $request->get('addTimeMultiple');
                    $tour->save();
                }

                $currentDate->addDay();
            } while ($currentDate->lte($endDate));
        }

        return redirect()->action('TourController@index');
    }

    /* Displays information about a tour. */
    public function show(Request $request, $id)
    {
        $tour = Tour::find($id);

        return view('admin.tours.show', [
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

        return view('admin.tours.deleted', [
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
