<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Tour;
use App\StudentStatus;
use App\Attendee;
use Carbon\Carbon;

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

    public function tourSelection(Request $request)
    {
        $token = $request->get("token");

        $month = $request->get('a', date('m'));
        
        if(date("F")==$month)
        {
            $dateStart = date("Y-m-d");
        }
        else
        {
            $dateStart = Carbon::parse('first day of '.$month.' 2018')->format("Y-m-d");
        }


        
        $dateEnd = Carbon::parse('last day of '.$month.' 2018')->format("Y-m-d");
        //dd($dateStart);
        //dd($dateEnd);
        
        $tours = Tour::wherebetween('date',[$dateStart, $dateEnd])->orderBy('date')
        ->orderBy('time')
        ->paginate(15);

        return view('attendeeView.tour')->with(['tours'=>$tours,'token'=>$token]);
    }
    public function saveTour(Request $request,$id)
    {
        $token = $request->get("token");

        $attendee = Attendee::where('token',$token)->first();
        
        $attendee->tour_id = $id;
        
        $attendee->save();
        
        
        $tour = Tour::find($id);

        return view("attendeeView.success")->with(['attendee'=>$attendee,'tour'=>$tour]);
    }
}
