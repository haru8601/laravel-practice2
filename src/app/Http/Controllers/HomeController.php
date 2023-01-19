<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * 初期表示画面
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $user = $request->session()->get('github_user', null);
        if ($user == null) {
            return view('welcome');
        }
        $bbs =  Bbs::select("comment", "gitusers.github_id", "images.filename")->join("images", "images.bbs_id", "=", "bbs.id")->join("gitusers", "gitusers.id", "=", "bbs.user_id")->get();
        return view('home')->with('bbs', $bbs);
    }

    public function sessionFlush(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
