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

    <!-- 投稿 -->
    @isset($bbs)
        @foreach ($bbs as $row)
            <h2>{{ $row->name }}さんの投稿</h2>
            {{ $row->comment }}
            <br>
            <hr>
        @endforeach
    @endisset

    <!-- フォーム -->
    <h2>フォーム</h2>
    <form action="/bbs" method="post">
        名前:<br>
        <input name="name">
        <br>
        コメント:<br>
        <textarea name="comment" rows="4" cols="40"></textarea>
        <br>
        {{ csrf_field() }}
        <button class="btn btn-success">送信</button>
    </form>
</body>

</html>
