<?php

namespace App\Http\Controllers;

use App\Models\Bbs;
use App\Models\Gituser;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BbsController extends Controller
{
    /**
     * 画像投稿画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        $gitUserName = $request->session()->get('git_username', null);
        if ($gitUserName == null) {
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
            $appUserId = Gituser::where("github_id", "=", $request->session()->get('git_username'))->sole()->value('id');
            $bbsId = Bbs::insertGetId(["comment" => $request->input('comment'), "user_id" => $appUserId, "created_at" => $nowTime, "updated_at" => $nowTime]);
            /* 画像パスをDBに保存 */
            Image::insert(["filename" => $path, "bbs_id" => $bbsId, "created_at" => $nowTime, "updated_at" => $nowTime]);
            return redirect("/");
        }
        return redirect()->back()->withInput()->withErrors("error");
    }

    /**
     * 投稿削除
     * @param Request $request
     * @param string $bbsId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, string $bbsId)
    {
        if ($request->session()->get('git_username') == null) {
            return redirect()->back()->withInput()->withErrors("error");
        }
        $filename = basename(Image::where("bbs_id", "=", $bbsId)->value('filename'));
        var_dump($filename);
        Storage::disk('public')->delete($filename);
        Bbs::find($bbsId)->delete();
        Image::where("bbs_id", "=", $bbsId)->delete();
        return redirect("/");
    }

    /**
     * いいね追加/取り消し
     * @param Request $request
     * @param string $bbsId
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function like(Request $request, string $bbsId)
    {
        $likeUserId = Gituser::where(['github_id' => $request->session()->get('git_username')])->value('id');
        $id = Like::where(['bbs_id' => $bbsId, 'like_user_id' => $likeUserId])->value('id');
        if ($id != null) {
            Like::find($id)->delete();
        } else {
            $nowTime = date('Y/m/d H:i:s');
            Like::insert(['bbs_id' => $bbsId, "like_user_id" => $likeUserId, "created_at" => $nowTime, "updated_at" => $nowTime]);
        }
        return redirect()->back();
    }
}
