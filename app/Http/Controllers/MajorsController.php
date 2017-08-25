<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use Carbon\Carbon;

class MajorsController extends Controller
{
    public function index(Request $request)
    {
        // Build a query
        $majors = Major::orderBy('name', 'desc')
        ->paginate(15)
        ->all();
        
        return view('admin.majors',['majors' => $majors]);
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required'
        ]);


        // Create the new major.
        $major = new Major();

        $major->name = $request->get('name');
        $major->code = $request->get('code');
        
        $major->save();

        // Redirect to the main tours panel.
        return redirect()->action('MajorsController@index');
    }


    public function make_visible(Request $request)
    {

    }

    public function destroy(Request $request, $id)
    {
        
    }

    public function show(Request $request, $id)
    {

    }


}

