<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 初期画面表示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $gitUsername = $request->session()->get('git_username', null);
        if ($gitUsername == null) {
            return view('welcome');
        }
        $bbs = Bbs::select("bbs.id", "bbs.comment", "gitusers.github_id", "images.filename", "likes.id as likeId")->join("images", "images.bbs_id", "=", "bbs.id")->join("gitusers", "gitusers.id", "=", "bbs.user_id")->leftjoin("likes", "likes.bbs_id", "=", "bbs.id")->get();
        return view('home')->with('bbs', $bbs)->with('gitUsername', $gitUsername);
    }

    public function sessionFlush(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
