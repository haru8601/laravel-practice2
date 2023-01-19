<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>github</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 class="text-xl">Home</h1>

        @isset($bbs)
            @foreach ($bbs as $post)
                <div class="border rounded">
                    <p>{{ $post->github_id }}</p>
                    <div>
                        <img width="300" height="auto" src="{{ asset('storage/' . basename($post->filename)) }}">
                    </div>
                    <p>{{ $post->comment }}</p>
                </div>
            @endforeach
        @endisset
    </main>

</body>

</html>
