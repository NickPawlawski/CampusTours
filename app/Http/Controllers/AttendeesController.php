<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;

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

      return view('admin.attendee_show',['attendee' => $attendee]);
  }

  




}