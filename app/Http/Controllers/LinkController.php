<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Links;

class LinkController extends Controller
{

    public function index(Request $request)
    {
        $links = Links::all();

        return view('Link.index',['links'=>$links]);
    }

    public function changeActive(Request $request, $id)
    {
        $link = Links::find($id);

        if($link->active == 1)
        {
            $link->active = 0;
        }
        else
        {
            $link->active = 1;
        }

        $link->save();


        $links = Links::all();

        return view('Link.index',['links'=>$links]);
    }

    public function addLink(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'description' => 'required'
        ]);

        $link = new Links();

        $link->name = $request->get('name');
        $link->link = $request->get('link');
        $link->description = $request->get('description');
        $link->active = 1;

        $link->save();

        $links = Links::all();

        return view('Link.index',['links'=>$links]);
    }

    public function deleteLink(Request $request,$id)
    {
        $link = Links::find($id);

        $link->delete();

        $links = Links::all();

        return view('Link.index',['links'=>$links]);
    }
    
}
