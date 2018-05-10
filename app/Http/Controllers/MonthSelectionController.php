<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attendee;

class MonthSelectionController extends Controller
{
    public function store(Request $request)
    {
        
        $errors = $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'visitors' => 'required|min:1|max:420',
            'major' => 'required'
        ]);
        
        

        $attendee = new Attendee();

        $attendee->firstName = $request->get('firstName');
        $attendee->lastName = $request->get('lastName');
        $attendee->email = $request->get('email');
        $attendee->phone = $request->get('phone');
        $attendee->considerations = $request->get('considerations');
        $attendee->visitors = $request->get('visitors');
        $attendee->major = $request->get('major');

        $attendee->attended = 0;
        $attendee->visited = 0;
        $attendee->viewable = 0;
        $attendee->token = str_random(16);

        $attendee->save();
        

        return view('attendeeView.month',['attendee' => $attendee]);
    }
}
