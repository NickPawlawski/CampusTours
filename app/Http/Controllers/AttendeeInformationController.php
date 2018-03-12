<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Attendee;
use App\Major;
use App\Term;
use App\StudentStatus;
use Carbon\Carbon;

class AttendeeInformationController extends Controller
{
    
    public function index(Request $request,$id)
    {
        $attendee = Attendee::where('token',$id)->firstorfail();
        
        //dd($attendee->viewable == 0 && !$request->exists("viewPage"));

        if($attendee->viewable == 0 && !$request->exists("viewPage"))
        {
            return view("attendeeVisit.attendee_not_viewable");
        }


        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();

        $attendee->studentType = $request->get("type"); 

        $attendee->save();

        return view('admin.attendee_information')->with([
            'attendee'=>$attendee,
            'majors'=>$majors,
            'terms'=>$terms,
            'studentTypes'=>$studentTypes
        ]);

    }

    public function update(Request $request, $id)
    {
        $attendee = Attendee::where('token',$id)->firstorfail();
        
        if($attendee->viewable == 0)
        {
            return view("attendeeVisit.attendee_not_viewable");
        }

        $errors = $this->validate($request,[
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        ]);

       

        if($attendee->studentType == 2)
        {
            $errors = $this->validate($request,[
                'hsName' => 'required',
                'hsCity' => 'required',
                'hsGpa' => 'required',
                'act' => 'required',
                'currentGrade' => 'required'
            ]);
        }
        else if ($attendee->studentType == 1)
        {
            $errors = $this->validate($request,[
                'collegeName' => 'required',
                'collegeCity'=> 'required',
                'collegeGpa' => 'required'
            ]);
        }

        $attendee->address = $request->get("address");
        $attendee->city = $request->get("city");
        $attendee->state = $request->get("state");
        $attendee->zip = $request->get("zip");

        if($attendee->studentType == 2)
        {
            $attendee->highschoolname = $request->get("hsName");
            $attendee->highschoolcity = $request->get("hsCity");
            $attendee->highschoolgpa = $request->get("hsGpa");
            $attendee->highschoolact = $request->get("act");
            $attendee->highschoolgrade = $request->get("currentGrade");

        }
        else if ($attendee->studentType == 1)
        {
           $attendee->collegename = $request->get("collegeName");
           $attendee->collegecity = $request->get("collegeCity");
           $attendee->collegegpa = $request->get("collegeGpa");
        }

        $attendee->viewable = 0;
        //dd($attendee->viewable);
        $attendee->save();

        return view('admin.attendee_information_complete')->with([
            'attendee'=>$attendee
        ]);
    }

    

    public function get_type(Request $request,$id)
    {
        $attendee = Attendee::where('token',$id)->firstorfail();
        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();

        if($attendee->viewable == 0 && !$request->exists("viewPage"))
        {
            return view("attendeeVisit.attendee_not_viewable");
        }

        return view('admin.attendee_information_type')->with([
            'attendee'=>$attendee,
            'majors'=>$majors,
            'terms'=>$terms,
            'studentTypes'=>$studentTypes
        ]);

    }
}
