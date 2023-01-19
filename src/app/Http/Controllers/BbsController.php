<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use App\Models\Image;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    /**
     * 画像投稿画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        $user = $request->session()->get('github_user', null);
        if ($user == null) {
            return redirect('/');
        }
        return view('bbs.index');
    }

    /**
     * 投稿処理
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(Request $request)
    {
        /* バリデーション */
        $this->validate($request, [
            'file' => [
                'required',
                "file",
                "image",
                "mimes:jpeg,png"
            ],
            'comment' => 'required|min:5|max:200',
        ]);
        if ($request->file('file')->isValid()) {
            /* 画像をstorageに保存 */
            $path = $request->file->store('public');

            $nowTime = date('Y/m/d H:i:s');
            $bbsId =    Bbs::insertGetId(["comment" => $request->input('comment'), "user_id" => $request->session()->get('user_id'), "created_at" => $nowTime, "updated_at" => $nowTime]);
            /* 画像パスをDBに保存 */
            Image::insert(["filename" => $path, "bbs_id" => $bbsId, "created_at" => $nowTime, "updated_at" => $nowTime]);
            return redirect("/");
        }
        return redirect()->back()->withInput()->withErrors("error");
    }
}
