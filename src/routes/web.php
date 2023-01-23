<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BbsController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/bbs', [BbsController::class, 'index']);
Route::post('/bbs', [BbsController::class, 'create']);
Route::get('/bbs/delete/{bbsId}', [BbsController::class, 'delete']);
Route::get('/bbs/like/{bbsId}', [BbsController::class, 'like']);

/* github用ルーティング */
Route::get('login/github', [LoginController::class, "redirectToProvider"]);
Route::get('login/github/callback', [LoginController::class, "handleProviderCallback"]);

/* テスト用 */
Route::get("/session/flush", [HomeController::class, "sessionFlush"]);
Route::get("/login/test", [LoginController::class, "test"]);
