<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Tour;

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
        $tours = Tour::where('date','>',date('Y-m-d'))->get();
        
        //dd($tours);

        return view('home')->with(['majors'=>$majors,'tours'=>$tours]);
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'studentType' => 'required',
            'visitors' => 'required|min:1|max:420',
            'major' => 'required'
        ]);
        
        $attendee = new Attendee();

        $attendee->firstName = $request->get('firstName');
        $attendee->lastName = $request->get('lastName');
        $attendee->email = $request->get('email');
        $attendee->phone = $request->get('phone');
        $attendee->studentType = $request->get('studentType');
        $attendee->considerations = $request->get('considerations');
        $attendee->visitors = $request->get('visitors');

        
        
        return view('home');
    }
}
