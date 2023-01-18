<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BbsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user', [UserController::class, "updateUser"]);

Route::get('/bbs', [BbsController::class, 'index']);
Route::post('/bbs', [BbsController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* github用ルーティング */
Route::get('github', [GithubController::class, "top"]);
Route::post('github/issue', [GithubController::class, "createIssue"]);
Route::get('login/github', [LoginController::class, "redirectToProvider"]);
Route::get('login/github/callback', [LoginController::class, "handleProviderCallback"]);
