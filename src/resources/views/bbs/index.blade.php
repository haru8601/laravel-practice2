<x-app-layout>
    <x-slot name="header">
        <h1>投稿</h1>
    </x-slot>
    <div class="m-5">
        <!-- エラーメッセージ -->
        @if ($errors->any())
            <h2>エラーメッセージ</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- フォーム -->
        <form action="/bbs" method="POST" enctype="multipart/form-data">
            <div style="display: flex">
                @isset($filenameList)
                    @foreach ($filenameList as $filename)
                        <div>
                            <img width="300" height="auto" src="{{ asset('storage/' . $filename) }}">
                        </div>
                    @endforeach
                @endisset
            </div>

            <label for="photo">写真を選択:</label>
            <input type="file"
                class="form-control block w-full text-sm text-slate-500
        file:mr-4 file:p-4
        file:rounded-full file:border-0
        file:text-sm file:font-semibold
        file:bg-violet-200 file:text-violet-700
        hover:file:bg-violet-300"
                name="file">
            <br>
            <hr>
            {{ csrf_field() }}
            <textarea name="comment" rows="4" cols="40" placeholder="旅行に行ったよ"></textarea>
            <br>
            {{ csrf_field() }}
            <button class="btn btn-success mt-4 px-4 py-2 bg-sky-300 text-sky-700 rounded">投稿</button>
        </form>
    </div>
</x-app-layout>
