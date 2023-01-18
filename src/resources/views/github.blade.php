<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>github</title>
</head>

<body>
    <form action="/user" method="POST">
        {{ csrf_field() }}
        <div>お名前: <input name="name" value="{{ $user->name }}"></div>
        <div>コメント: <input name="comment" value="{{ $user->comment }}"></div>
        <input type="submit" value="Confirm">
    </form>
    <div>ニックネーム: {{ $nickname }}</div>
    <div>トークン: {{ $token }}</div>
    <div>リポジトリ一覧</div>
    <ul>
        @foreach ($repoList as $repo)
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
