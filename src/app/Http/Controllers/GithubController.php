<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GithubController extends Controller
{
    /**
     * github用トップ画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function top(Request $request)
    {
        /* セッションからgithubユーザー取得 */
        $gitUsername = $request->session()->get('git_username', null);

        /* なければログイン処理 */
        if ($gitUsername == null) {
            return redirect('login/github');
        }
        return redirect("/");
    }
}
