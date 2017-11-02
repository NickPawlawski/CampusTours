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
        $major->graduate = $request->exists('graduate');
        $major->undergraduate = $request->exists('undergraduate');
        
        $major->save();

        // Redirect to the main tours panel.
        return redirect()->action('MajorsController@index');
    }


    public function make_visible(Request $request)
    {
        $major = Major::find($request->get('id'));

        $major->active = !$major->active;

        $major->save();

        return redirect()->action('MajorsController@index');
    }

    public function destroy(Request $request, $id)
    {
        $major = Major::find($id);

        $major->delete();

        return redirect()->action('MajorsController@index');
    }

    public function show(Request $request, $id)
    {
        $major = Major::find($id);
        
        return view('admin.major_show',['major' => $major]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required'
        ]);
        
        $major = Major::find($id);

        $major->name = $request->get('name');
        $major->code = $request->get('code');
        $major->graduate = $request->exists('graduate');
        $major->undergraduate = $request->exists('undergraduate');

        $major->save();

        return redirect()->action('MajorsController@index');
    }

}