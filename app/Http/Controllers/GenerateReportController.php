<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Attendee;
use Carbon\Carbon;

class GenerateReportController extends Controller
{
    public function index()
    {
        

        return view('admin.report.report_dates');
    }

    public function generate(Request $request)
    {
        $this->validate($request, [
            'filterDateStart' => 'date|required',
            'filterDateEnd' => 'date|required',
        ]);

        $startDate = date('Y-m-d', strtotime($request['filterDateStart']));
        $endDate = date('Y-m-d', strtotime($request['filterDateEnd']));

        
        $attendees = Attendee::with(['tour'=> function($query) use($startDate, $endDate)
        {
            $query->whereBetween('date',[$startDate, $endDate]);
        }])->get();
        $attendees = Attendee::with('tour')->get();
        //dd($attendees);
        return view('admin.report.show_report')->with(['attendees'=>$attendees]);
    }
}