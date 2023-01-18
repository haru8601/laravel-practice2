<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

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
        $user = $request->session()->get('github_user', null);

        /* なければログイン処理 */
        if ($user == null) {
            return redirect('login/github');
        }

        /* github apiからリポジトリ一覧を取得 */
        $repoList = Http::withToken($user->token)->get("https://api.github.com/user/repos");

        return view('github', [
            'info' => var_dump($user),
            'nickname' => $user->nickname,
            'token' => $user->token,
            'repos' => array_map(function ($repo) {
                return $repo->name;
            }, json_decode($repoList->getBody()))
        ]);
    }

    /**
     * issueを作成しgithubへ送信
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createIssue(Request $request)
    {
        /* セッションからgithubユーザー取得 */
        $user = $request->session()->get('github_user', null);
        if ($user == null) {
            return redirect('login/github');
        }

        // github apiへissueデータを送信
        $res = Http::withToken($user->token)->post("https://api.github.com/repos/" . $user->user['login'] . '/' . $request->input('repo') . '/issues', [
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);
        return view('done', [
            'response' => json_decode($res->getBody())->html_url
        ]);
    }
}
