<?php

namespace App\Http\Controllers;

use App\Models\User;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function index()
    {
        $email = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '@yyyy.com';
        User::insert(['name' => 'haroot', 'email' => $email, 'password' => 'xxxxxxxx']);
        $users = User::all();
        return view('user', ['users' => $users]);
    }
}
