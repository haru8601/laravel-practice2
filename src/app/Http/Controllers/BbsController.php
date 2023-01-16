<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BbsController extends Controller
{
    //
    public function index()
    {
        return view('bbs.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10',
            'comment' => 'required|min:5|max:140',
        ]);
        $name = $request->input('name');
        $comment = $request->input('comment');
        return view('bbs.index')->with(['name' => $name, 'comment' => $comment]);
    }
}
