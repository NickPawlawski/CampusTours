<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentStatus;
use Carbon\Carbon;

class StudentStatusController extends Controller
{
    public function index(Request $request)
    {
        
        $studentStatus = StudentStatus::orderBy('name', 'desc')
        ->paginate(15)
        ->all();
        
        return view('admin.student_status',['studentStatus' => $studentStatus]);

    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            
        ]);

        
        $studentStatus = StudentStatus::find($id);
        

        if($studentStatus->name == "N/A")
        {
            $studentStatus->name = $studentStatus->old_name;
            $studentStatus->old_name = "";
        }
        else
        {
            $studentStatus->name = $request->get('name');
        }

        $studentStatus->save();


        return redirect(route('student.status'));
    }

    public function delete(Request $request, $id)
    {
        $studentStatus = StudentStatus::find($id);

        $studentStatus->old_name = $studentStatus->name;
        $studentStatus->name = "N/A";

        $studentStatus->save();

        return redirect(route('student.status'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        
        $studentStatus = new StudentStatus();
        $studentStatus->name = $request->get('name');

        $studentStatus->save();


        return redirect(route('student.status'));
    }
}