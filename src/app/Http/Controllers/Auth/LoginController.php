<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gituser;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /***** とりあえずgithubのみ *****/

    /**
     * githubの認証画面へリダイレクト
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect();
    }

    /**
     * githubからのコールバック後処理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback(Request $request)
    {
        $gitUsername = Socialite::driver('github')->user()->user['login'];

        /* ユーザーがDBに存在していなければレコード作成 */
        $nowTime = date("Y/m/d H:i:s");
        $appUserId = Gituser::select("id")->where("github_id", $gitUsername)->first();
        if (empty($appUserId)) {
            Gituser::insert(["github_id" => $gitUsername, "created_at" => $nowTime, "updated_at" => $nowTime]);
        }

        $request->session()->put('git_username', $gitUsername);

        return redirect('/github');
    }

    public function test(Request $request)
    {
        $gitUsername = "test1";
        $nowTime = date("Y/m/d H:i:s");
        $appUserId = Gituser::select('id')->where("github_id", $gitUsername)->first();
        if (empty($appUserId)) {
            $appUserId = Gituser::insertGetId(["github_id" => $gitUsername, "created_at" => $nowTime, "updated_at" => $nowTime]);
        }
        $request->session()->put('git_username', $gitUsername);
        $request->session()->put('user_id', $appUserId);
        return redirect("/");
    }
}
