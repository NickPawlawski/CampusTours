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
        //dd($attendees);
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
        $startDate = $request->get("startDate");
        $filename = "ToursReport_". date('Ymd', strtotime($startDate)) . ".xls";


        dd($startDate);

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");


        return redirect()->back();
    }
     /*
  |--------------------------------------------------------------------------
  | Report controller
  |--------------------------------------------------------------------------
 

  public function post_make_report(){

    $view = View::make('pages.new_report');
      
      $startDate = strtotime($_POST['b_date']);
      $start = date('Y-m-d', $startDate);

      $endDate = strtotime($_POST['e_date']);
      $end = date('Y-m-d', $endDate);

      Session::put('downloadstart', $start);
      Session::put('downloadend', $end);
    $tourarray = Appointment::appointments_by_name_and_date('','',$start, $end);

    foreach ($tourarray as $tour) {
      $id = $tour -> id;
      $tour -> tdate = Appointment::appointment_date($id);
      $tour -> majors = Appointment::appointment_majors($id);
    }

    $view->tourarray = $tourarray;

    //return json_encode($tourarray);
    return $view;
  }

  public function get_download_report() {
    $start = Session::get('downloadstart');
    $end = Session::get('downloadend');
    $tourarray = Appointment::appointments_by_name_and_date('','',$start, $end);

    $formattedarray = array();
    $index = 0;
    foreach ($tourarray as $tour) {
      $id = $tour->id;
      $tour->tdate = Appointment::appointment_date($id);
      $tour->majors = Appointment::appointment_majors($id);

      $temp = array();
      $temp['id'] = $id;
      $temp['fname'] = $tour->fname;
      $temp['lname'] = $tour->lname;
      $temp['email'] = $tour->email;
      $phone = str_replace(['(', ')', '-', ' ', '.'], '', $tour->phone);
      $temp['phone'] = $phone;
      $temp['xfer'] = $tour->xfer;
      $temp['term'] = $tour->term;
      $temp['year'] = $tour->year;
      $temp['grad'] = $tour->grad == 0 ? "No":"Yes";
      $string = "";
      if (isset($tour->majors)) {   
        foreach ($tour->majors as $major) {
          $string .= $major->name.',';
        }
        $string = rtrim($string, ",");
        $temp['majors'] = $string;
      }
      else
      {
        $temp['majors'] = "None";
      }

      $temp['othermajor'] = empty($tour->othermajor) ? "N/A" : $tour->othermajor;
      $temp['considerations'] = $tour->consid;
      $temp['visitors'] = $tour->visitors;
      $temp['tourdate'] = $tour->ttime;
      $temp['checkedin'] = $tour->checkedin == 0 ? "No" : "Yes"; 

      $formattedarray[$index] = $temp;
      $index++;
    }

    // filename for download
    $filename = "ToursReport_". date('Ymd', strtotime($start)) . ".xls";

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
   */
}