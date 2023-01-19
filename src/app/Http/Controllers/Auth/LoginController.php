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
        $user = Socialite::driver('github')->user();

        /* ユーザーがDBに存在していなければレコード作成 */
        $nowTime = date("Y/m/d H:i:s");
        $appUser = Gituser::where("github_id", $user->user['login'])->first();
        $userId = -1;
        if (empty($appUser)) {
            $userId = Gituser::insertGetId(["github_id" => $user->user['login'], "created_at" => $nowTime, "updated_at" => $nowTime]);
        } else {
            $userId = $appUser->id;
        }

        $request->session()->put('github_user', $user);
        $request->session()->put('user_id', $userId);

        return redirect('/github');
    }
}
