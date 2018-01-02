<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\Major;
use App\Term;
use App\StudentStatus;

class AttendeesController extends Controller
{

  public function index(Request $request)
  {
    $attendees = Attendee::orderBy('firstName', 'desc')
    ->paginate(15)
    ->all();
    
    return view('admin.attendees',['attendees' => $attendees]);
  }

  public function show(Request $request, $id)
  {
    $attendee = Attendee::find($id);
    
    $majors = Major::get();
    $terms = Term::get();
    $studentTypes = StudentStatus::get();
      
    return view('admin.attendee_show')->with(['attendee'=>$attendee,'majors'=>$majors,'terms'=>$terms,'studentTypes'=>$studentTypes]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required'
    ]);
  
    $attendee = Attendee::find($id);

    $attendee->name = $request->get('name');

    $major->save();

    return redirect()->action('attendee_show@index');
  }
  
}