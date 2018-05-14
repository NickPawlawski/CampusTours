<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Attendee;
use App\Major;
use App\Term;
use App\StudentStatus;
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

        $majors = Major::get();
        $terms = Term::get();
        $studentTypes = StudentStatus::get();
        
        return view('admin.report.show_report')->with([
            'attendees'=>$attendees,
            'majors'=>$majors,
            'terms'=>$terms,
            'studentTypes'=>$studentTypes,
            'startDate'=>$startDate,
            'endDate'=>$endDate
        ]);
    }

    public function downloadReport(Request $request)
    {
      $startDate = date('Y-m-d', strtotime($request['startDate']));
      $endDate = date('Y-m-d', strtotime($request['endDate']));

      
      $attendees = Attendee::with(['tour'=> function($query) use($startDate, $endDate)
      {
          $query->whereBetween('date',[$startDate, $endDate]);
      }])->get();

      $majors = Major::get();
      $terms = Term::get();
      $studentTypes = StudentStatus::get();

      $formattedarray = array();
      $index = 0;
      foreach ($attendees as $attendee) {
        if($attendee->tour_id != null)
        {
  
          $temp = array();
          $temp['FirstName'] = $attendee->firstName;
          $temp['LastName'] = $attendee->lastName;
          $temp['Email'] = $attendee->email;
          $phone = str_replace(['(', ')', '-', ' ', '.'], '', $attendee->phone);
          $temp['PhoneNumber'] = $phone;
          
          $temp['Major'] = $majors[$attendee->major-1]->name;

          if($attendee->studentType != null)
            $temp['StudentType'] = $studentTypes[$attendee->studentType-1]->name;
          else
            $temp['StudentType'] ="";
    
          if($attendee->startTerm != null)
            $temp['StartTerm'] = $terms[$attendee->startTerm-1]->name;
          else
            $temp['StartTerm'] ="asd";
          
          $temp['Considerations'] = $attendee->considerations;
          $temp['Visitors'] = $attendee->visitors;
          $temp['Attended'] = $attendee->attended == 0 ? "No" : "Yes"; 
    
          if($attendee->address != null)
          {
            $temp['Address'] = $attendee->address;
            $temp['City'] = $attendee->city;
            $temp['State'] = $attendee->state;
            $temp['Zip'] = $attendee->zip;
          }
          else
          {
            $temp['Address'] = "";
            $temp['City'] = "";
            $temp['State'] = "";
            $temp['Zip'] = "";
          }
          
          if($attendee->highschoolname != null)
          {
            $temp['HighschoolName'] = $attendee->highschoolname;
          }
          else
          {
            $temp['HighschoolName'] = "";
          }

          if($attendee->collegename != null)
          {
            $temp['CollegeName'] = $attendee->collegename;
          }
          else
          {
            $temp['collegCollegeNameeName'] = "";
          }

          $formattedarray[$index] = $temp;
          $index++;
        }
        
      }

        $filename = "ToursReport_". date('Ymd', strtotime($startDate)) . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
      //return json_encode($formattedarray);
        foreach($formattedarray as $row) {
          if(!$flag) {
            // display field/column names as first row
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
          }
          echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }
}