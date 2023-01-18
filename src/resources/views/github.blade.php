<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>github</title>
</head>

<body>
    <div>{{ $info }}</div>
    <div>ニックネーム: {{ $nickname }}</div>
    <div>トークン: {{ $token }}</div>
    <div>リポジトリ一覧</div>
    <ul>
        @foreach ($repos as $repo)
            <li>{{ $repo }}</li>
        @endforeach
    </ul>

    <form action="/github/issue" method="POST">
        {{ csrf_field() }}
        <div>repo: <input type="text" name="repo"></div>
        <div>title: <input type="text" name="title"></div>
        <div>body: <input type="text" name="body"></div>
        <input type="submit" value="Confirm">
    </form>

</body>

</html>
