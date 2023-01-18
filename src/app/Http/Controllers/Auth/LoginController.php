<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $appUser = DB::select('select * from public.user where github_id = ?', [$user->user['login']]);
        if (empty($appUser)) {
            DB::insert('insert into public.user (github_id, created_at, updated_at) values (?, ?, ?)', [$user->user['login'], $nowTime, $nowTime]);
        }

        $request->session()->put('github_user', $user);

        return redirect('/github');
    }
}
