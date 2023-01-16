<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    //
    public function index()
    {
        $bbs = Bbs::all();
        return view('bbs.index', ["bbs" => $bbs]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10',
            'comment' => 'required|min:5|max:140',
        ]);
        $name = $request->input('name');
        $comment = $request->input('comment');
        Bbs::insert(["name" => $name, "comment" => $comment]);
        $bbs = Bbs::all();
        return view('bbs.index', ["bbs" => $bbs]);
    }
}
