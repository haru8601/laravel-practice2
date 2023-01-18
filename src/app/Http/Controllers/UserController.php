<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = $request->session()->get('github_user', null);
        if ($user == null) {
            return redirect('/login/github');
        }

        DB::update('update public.user set name = ?, comment = ? where github_id = ?', [$request->input('name'), $request->input('comment'), $user->user['login']]);
        return redirect('/github');
    }
}
