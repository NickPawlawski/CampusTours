<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Tour;
use App\StudentStatus;
use App\Attendee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Major::all();
        $tours = Tour::where('date','>',date('Y-m-d'))->orderby('date')->get();

        $statuses = StudentStatus::all();
        
        //dd($tours);

        return view('home')->with(['majors'=>$majors,'tours'=>$tours,'statuses'=>$statuses]);
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function store(Request $request)
    {
        
        $errors = $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
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
        

        return view('attendee.month',['attendee' => $attendee]);
    }

    public function monthSelction(Request $request,$id)
    {
        return view(route('monthSelection'));
    }

    public function tourSelection(Request $request,$id)
    {
        return "success";
    }
}
