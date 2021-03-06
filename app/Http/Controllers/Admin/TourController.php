<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Attendee;
use App\Major;
use App\Term;
use App\StudentStatus;
use Carbon\Carbon;
use Mail;   

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
            ->orderBy('date')
            ->orderBy('time')
            ->paginate(5);
        
        
        
        $todayTours = Array();
        $todayToursAttendee = Array();
        $todayToursVisitor = Array();
        foreach($tours as $tour)
        {
            $attendeeGroup = Attendee::where('tour_id','=',$tour->id)->get();
            //dd($tour->id);

            $sum = 0;
            
            foreach($attendeeGroup as $attend)
            {
                //echo($attend->visitors);
                $sum += $attend->visitors;
            }
            $attendeeTotal[] = $attendeeGroup->count();
            $visitorTotal[] = $sum;

            if($tour->date->format('Y-m-d') == Carbon::now()->format('Y-m-d'))
            {
                $todayTours[] = $tour;
                $todayToursAttendee[] = $attendeeGroup->count();
                $todayToursVisitor[] = $sum;
            }
            //dd($sum);
        }
        
        

        // Return the tours view.
        return view('admin.tours.index', [
            'tours' => $tours,
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd,
            'visitorTotal' => $visitorTotal,
            'attendeeTotal' => $attendeeTotal,
            'todayTours' => $todayTours,
            'todayToursAttendee' => $todayToursAttendee,
            'todayToursVisitor' =>  $todayToursVisitor
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

    /* Creates a single tour from a date and time.
     * 
     * date: A carbon object that will be copied before storage.
     * time: A string in the format H:i.
     */
    private function storeSingleTour($date, $time)
    {
        $tour = new Tour();
        $tour->date = $date->copy();
        $tour->time = $time;
        $tour->save();
    }

    public function deleteMultiple(Request $request)
    {
        //validate the dates and time
        $this->validate($request, [
                'deleteDateStart' => 'required|date_format:Y-m-d',
                'deleteDateEnd' => 'required|date_format:Y-m-d'
                //'deleteTimeMultiple' => 'required|date_format:H:i'
            ]);

        $startDate = date('Y-m-d', strtotime($request['deleteDateStart']));
        $endDate = date('Y-m-d', strtotime($request['deleteDateEnd']));
        //$deleteTime = date('g:i A', strtotime($request['deleteTimeMultiple']));

        //keep track of whether any tours were created
        $tourCount = 0;

        //delete all tours between the determined dates
        Tour::whereBetween('date', [$startDate, $endDate])->each(function ($item) use($tourCount)
        {
            $item->delete();
        });

        //output date range of deleted tours
        //$message = "Deleted $tourCount tours between $startDate and $endDate at $deleteTime.";
        $message = "Deleted all tours between $startDate and $endDate.";
        $request->session()->flash('deleteMultipleWarning', $message);    

        return redirect()->action('TourController@index');
    }


    public function storeMultiple(Request $request)
    {
        // Validate the dates and time.
        $this->validate($request, [
                'addDateStart' => 'required|date_format:Y-m-d',
                'addDateEnd' => 'required|date_format:Y-m-d',
                'addTimeMultiple' => 'required|date_format:H:i',
                'addDayOfWeek' => 'required|array',
            ]);

        $startDate = new Carbon($request->get('addDateStart'));
        $endDate = new Carbon($request->get('addDateEnd'));
        // Keep track of whether any tours were created.
        $tourCount = 0;

        // Ensure that the end date is 6 months after the start or sooner.
        if ($startDate->copy()->addMonths(6)->lt($endDate)) {
            $endDate = $startDate->copy()->addMonths(6);
        }

        // Verify that the start date is before the end date.
        if ($startDate->lte($endDate)) {
            for ($day = 1; $day <= 6; $day += 1) {
                // Current date to create a new instance of a tour with.
                $currentDate = new Carbon($request->get('addDateStart'));

                if (in_array("$day", $request->get('addDayOfWeek'))) {
                    $currentDate->next($day);

                    while ($currentDate->lte($endDate)) {
                        $this->storeSingleTour($currentDate, $request->get('addTimeMultiple'));
                        $currentDate->next($day);
                        $tourCount += 1;
                    }
                }
            }
        }

        if ($tourCount == 0) {
            $request->session()->flash('addMultipleWarning', 'No tours were created.');
        } else {
            $message = "$tourCount tours were created.";
            if ($tourCount == 1) {
                $message = "1 tour was created.";
            }
            $request->session()->flash('addMultipleStatus', $message);
        }

        return redirect()->action('TourController@index');
    }

    /* Displays information about a tour. */
    public function show(Request $request, $id)
    {
        $tour = Tour::find($id);
        $attendees = Attendee::where('tour_id', $id)->get();
        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();
        //dd($attendees);

        return view('admin.tours.show', [
            'tour' => $tour,
            'attendees'=>$attendees,
            'majors' => $majors,
            'terms' => $terms,
            'studentTypes' => $studentTypes
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

    public function sendEmail(Request $request,$id,$tourID)
    {
        $attendee = Attendee::where('token',$id)->firstorfail();

        
        if($attendee->viewable != 1 && $attendee->visited == 0)
        {
            $email = "http://localhost/campustours/index.php/attendee_information/$attendee->token/type?";

            Mail::send('emails.reminder', ['user' => $attendee ,'email'=>$email], function ($m) use ($attendee) {
                $m->from('cae-programmers@wmich.edu', 'Nick')
                ->subject('Campus Tours');
            
                $m->to($attendee->email);
            });
        
            $attendee->visited = 1;
            $attendee->viewable = 1;

            $attendee->save();
        }
            

        

        $tour = Tour::find($tourID);
        $attendees = Attendee::where('tour_id', $tourID)->get();
        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();
            

        return view('admin.tours.show', [
            'tour' => $tour,
            'attendees'=>$attendees,
            'majors' => $majors,
            'terms' => $terms,
            'studentTypes' => $studentTypes
        ]);   
    }

    public function resetAttendee(Request $request,$id,$tourID)
    {
        $attendee = Attendee::where('token',$id)->firstorfail();

        $attendee->visited = 0;
        $attendee->viewable = 0;

        $attendee->address = null;
        $attendee->city = null;
        $attendee->state = null;
        $attendee->zip = null;

        $attendee->highschoolname = null;
        $attendee->highschoolcity = null;
        $attendee->highschoolgpa = null;
        $attendee->highschoolact = null;
        $attendee->highschoolgrade = null;

    
        $attendee->collegename = null;
        $attendee->collegecity = null;
        $attendee->collegegpa = null;

        $attendee->save();

        $tour = Tour::find($tourID);
        $attendees = Attendee::where('tour_id', $tourID)->get();
        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();
            

        return view('admin.tours.show', [
            'tour' => $tour,
            'attendees'=>$attendees,
            'majors' => $majors,
            'terms' => $terms,
            'studentTypes' => $studentTypes
        ]);   
    }
}
