<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class HomeController extends Controller
{
    /**
     * 初期表示画面
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index()
    {
        $filenameList = array_map(function ($row) {
            return basename($row->filename);
        }, DB::select('select * from public.image'));
        return view('home')->with('filenameList', $filenameList);
    }

    /**
     * 画像アップロード
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function upload(Request $request)
    {
        /* バリデーション */
        $this->validate($request, [
            'file' => [
                'required', "file", "image", "mimes:jpeg,png"
            ]
        ]);
        if ($request->file('file')->isValid()) {
            /* 画像をstorageに保存 */
            $path = $request->file->store('public');

            $nowTime = date('Y/m/d H:i:s');
            /* 画像パスをDBに保存 */
            DB::insert('insert into public.image (filename, created_at, updated_at) values(?, ?, ?)', [$path, $nowTime, $nowTime]);
            $filenameList = array_map(function ($row) {
                return basename($row->filename);
            }, DB::select('select * from public.image'));
            return view('home')->with('filenameList', $filenameList);
        }
        return redirect()->back()->withInput()->withErrors("error");
    }
}
