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
    $attendees = Attendee::orderBy('firstName', 'desc')
    ->paginate(15)
    ->all();
    
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
      'Visitors' => 'min:0|max:100'

    ]);
  
    $attendee = Attendee::find($id);

    $attendee->name = $request->get('firstName');

    $attendee->save();

    return redirect()->action('attendee_show@index');
  }
  
}