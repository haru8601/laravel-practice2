<x-app-layout>
    <x-slot name="header">
        <h1>Home</h1>
    </x-slot>
    <div class="m-5">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if ($bbs->isNotEmpty())
            <div class="mx-auto flex flex-col w-1/2">
                @foreach ($bbs as $post)
                    <div class="m-3 p-3 border-black border-2 rounded roundedplace-content-center">
                        <div class="flex justify-between">
                            <p>{{ '@' . $post['github_id'] }}</p>
                            @if ($gitUsername == $post['github_id'])
                                <a class="inline-block px-4 py-2 bg-rose-500 rounded hover:bg-rose-600"
                                    href="{{ '/bbs/delete/' . $post['id'] }}">delete</a>
                            @endif
                        </div>
                        <div class="mx-auto my-2 w-3/4">
                            <img class="rounded" src="{{ asset('storage/' . basename($post['filename'])) }}">
                        </div>
                        <div class="m-3 flex justify-between">
                            <div>{!! nl2br($post['comment']) !!}</div>
                            <a class="{{ 'h-fit inline-block px-4 py-2 border-4 border-yellow-300 rounded ' . (isset($post['like_id']) ? 'bg-yellow-300 hover:bg-yellow-400' : 'hover:bg-yellow-50 ') }}"
                                href="{{ '/bbs/like/' . $post['id'] }}">いいね</a>
                        </div>
                        <div class="text-right">
                            <a class="inline-block p-1 text-sm hover:border-b hover:border-black"
                                href="/">いいねしたユーザー</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div>
                <p>投稿はまだありません</p>
            </div>
        @endif
    </div>
</x-app-layout>
