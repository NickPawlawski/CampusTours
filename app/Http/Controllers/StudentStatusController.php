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
            'name' => 'required'
        ]);

        
        $studentStatus = StudentStatus::find($id);
        $studentStatus->name = $request->get('name');

        $studentStatus->save();


        return redirect(route('student.status'));
    }

    public function delete(Request $request, $id)
    {
        $studentStatus = StudentStatus::find($id);

        $studentStatus->delete();

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