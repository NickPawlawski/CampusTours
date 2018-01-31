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
        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();

        return view('admin.attendee_information')->with(['attendee'=>$attendee,'majors'=>$majors,'terms'=>$terms,'studentTypes'=>$studentTypes]);

    }

    public function update(Request $request, $id)
    {
        $errors = $this->validate($request,[
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        ]);

        $attendee = Attendee::where('token',$id)->firstorfail();

        if($attendee->studentType == 2)
        {
            $errors = $this->validate($request,[
                'hsName' => 'required',
                'hsCity' => 'required',
                'hsGpa' => 'required',
                'act' => 'required',
                'currentGrade' => 'required',
                'earlyCollege'  => 'exists'
            ]);
        }
        else if ($attendee->studentType == 1)
        {
            $errors = $this->validate($request,[
                'collegeName' => 'required',
                'collegeCity'=> 'required',
                'currentGpa' => 'required'
            ]);
        }
        dd();

        
    }
}
