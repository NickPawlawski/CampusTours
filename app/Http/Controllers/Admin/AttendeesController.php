<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\Major;
use App\Term;
use App\StudentStatus;
use App\Tour;

class AttendeesController extends Controller
{

  public function index(Request $request)
  {
    $attendees = Attendee::orderBy('lastName', 'asc')->where('tour_id','!=',NULL)
    ->paginate(15);
    
    $studentTypes = StudentStatus::get();

    return view('admin.attendees',['attendees' => $attendees,'studentTypes'=>$studentTypes]);
  }

  public function show(Request $request, $id)
  {
    $attendee = Attendee::find($id);
    
    $majors = Major::get();
    $terms = Term::get();
    $studentTypes = StudentStatus::get();
    
    $tour = Tour::find($attendee->tour_id);

    return view('admin.attendee_show')->
      with(['attendee'=>$attendee,
            'majors'=>$majors,
            'terms'=>$terms,
            'studentTypes'=>$studentTypes,
            'tour'=>$tour]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'Visitors' => 'min:0|max:100',
      'email' => 'nullable|email'
    ]);
    
    $attendee = Attendee::find($id);
    
    if($request->get('firstName') !== null)
    {
      $attendee->firstName = $request->get('firstName');
    }

    if($request->get('lastName') !== null)
    {
      $attendee->lastName = $request->get('lastName');
    }

    if($request->get('email') !== null)
    {
      $attendee->email = $request->get('email');
    }

    if($request->get('visitors') !== null)
    {
      $attendee->visitors = $request->get('visitors');
    }
        

    $attendee->save();

    return redirect()->action('AttendeesController@show',['id'=>$id]);
  }

  public function search(Request $request)
  {
    //dd($request->get('parameter'));
    $attendees = Attendee::orderBy('lastName', 'asc')->where([[$request->get('parameter'),'LIKE',"%".$request->get('searchValue')."%"],['tour_id','!=',NULL]])
    ->paginate(15);
    
    $studentTypes = StudentStatus::get();

    return view('admin.attendees',['attendees' => $attendees,'studentTypes'=>$studentTypes]);
  }
  
  public function searchDate(Request $request)
  {
    //dd($request->get('filterDateStart'));

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
    $tours = Tour::whereBetween('date', [$filterDateStart, $filterDateEnd])->pluck('id')->toArray();

    
    $attendees = Attendee::orderBy('lastName', 'asc')->wherein('tour_id',$tours)
    ->paginate(15);
    
    $studentTypes = StudentStatus::get();

    return view('admin.attendees',['attendees' => $attendees,'studentTypes'=>$studentTypes]);
  }

}