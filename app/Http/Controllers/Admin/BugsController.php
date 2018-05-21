<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bug;
use App\BugStatus;
use App\Page;
use Carbon\Carbon;

class BugsController extends Controller
{
    public function index(Request $request)
    {
        // Build a query
        $bugs = Bug::where('active',1)->get();

        //return '';
        
        $bugStatus = BugStatus::all();
        $pages = Page::all();
        
        return view('bugs.bugs',['bugs' => $bugs,
                                 'bugStatus' => $bugStatus,
                                 'pages'    => $pages]);
    }

    public function addBug(Request $request)
    {
        $this->validate($request, [
            'bugName' => 'required',
            'bugDescription' => 'required'
        ]);

        $bug = new Bug();

        $bug->name = $request->get('bugName');
        $bug->page = $request->get('page');
        $bug->description = $request->get('bugDescription');
        $bug->status = 1;

        $bug->save();

        // Build a query
        $bugs = Bug::where('active',1)->get();

        //return '';
        
        $bugStatus = BugStatus::all();
        $pages = Page::all();

        return view('bugs.bugs',['bugs' => $bugs,
                                 'bugStatus' => $bugStatus,
                                 'pages'    => $pages]);

    }

    public function show(Request $request, $id)
    {
        
        $bug = Bug::find($id);
        
        $bugStatus = BugStatus::all();
        $pages = Page::all();

        return view('bugs.show',['bug'=>$bug,
                                 'bugStatus' => $bugStatus,
                                 'pages'    => $pages]);
    }

    public function update(Request $request,$id)
    {
        
        $bug = Bug::find($id);

        $bug->status = $request->get('status');

        if($bug->status == 3)
        {
            $bug->active = 0;
        }
        else{
            $bug->active = 1;
        }

        $bug->save();

        $bugStatus = BugStatus::all();
        $pages = Page::all();

        return view('bugs.show',['bug'=>$bug,
                                 'bugStatus' => $bugStatus,
                                 'pages'    => $pages]);
    }

    public function old(Request $request)
    {
        
        $bugs = Bug::where('active','0')->get();

        $bugStatus = BugStatus::all();
        $pages = Page::all();

        return view('bugs.inactive',['bugs'=>$bugs,
                                 'bugStatus' => $bugStatus,
                                 'pages'    => $pages]);
    }

    

}