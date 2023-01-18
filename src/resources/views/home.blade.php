<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>github</title>
</head>

<body>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
        <div style="display: flex">
            @isset($filenameList)
                @foreach ($filenameList as $filename)
                    <div>
                        <img width="300" height="auto" src="{{ asset('storage/' . $filename) }}">
                    </div>
                @endforeach
            @endisset
        </div>

        <label for="photo">画像ファイル:</label>
        <input type="file" class="form-control" name="file">
        <br>
        <hr>
        {{ csrf_field() }}
        <button class="btn btn-success"> Upload </button>
    </form>
</body>

</html>
