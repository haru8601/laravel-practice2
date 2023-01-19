<!DOCTYPE html>
<html>

<head>
    <title>掲示板</title>
</head>

<body>
    <h1>掲示板</h1>
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
        <input type="file" class="form-control" name="file">
        <br>
        <hr>
        {{ csrf_field() }}
        キャプション:<br>
        <textarea name="comment" rows="4" cols="40"></textarea>
        <br>
        {{ csrf_field() }}
        <button class="btn btn-success">投稿</button>
    </form>
</body>

</html>
