<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use App\Models\Like;
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
        /** 自分がいいね押した記事一覧(サブクエリ用) */
        $likeUser = Like::select("likes.id as like_id", "likes.bbs_id")
            ->join("gitusers", "gitusers.id", "=", "likes.like_user_id")
            ->where(["gitusers.github_id" => $gitUsername]);
        $bbs = Bbs::select("bbs.id", "bbs.comment", "gitusers.github_id", "images.filename", "likeUser.like_id")
            ->join("images", "images.bbs_id", "=", "bbs.id")
            ->join("gitusers", "gitusers.id", "=", "bbs.user_id")
            ->leftjoinSub($likeUser, "likeUser", function ($join) {
                $join->on("bbs.id", "=", "likeUser.bbs_id");
            })
            ->orderBy("bbs.id")
            ->get();
        return view('home')->with('bbs', $bbs)->with('gitUsername', $gitUsername);
    }

    public function sessionFlush(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
