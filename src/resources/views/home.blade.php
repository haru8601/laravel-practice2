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

        @isset($bbs)
            <div class="mx-auto flex flex-col w-1/2">
                @foreach ($bbs as $post)
                    <div class="m-3 p-3 border border-black border-3 rounded roundedplace-content-center">
                        <div class="flex justify-between">
                            <p>{{ '@' . $post['github_id'] }}</p>
                            <a class="inline-block px-4 py-2 bg-rose-300 rounded" href="/">delete</a>
                        </div>
                        <div class="mx-auto my-2 w-3/4">
                            <img class="rounded" src="{{ asset('storage/' . basename($post['filename'])) }}">
                        </div>
                        <div class="m-3 flex justify-between">
                            <p>{{ $post['comment'] }}</p>
                            <a class="inline-block px-4 py-2 bg-yellow-300 rounded" href="/">いいね</a>
                        </div>
                        <div class="text-right">
                            <a class="inline-block p-1 text-sm hover:border-b hover:border-black"
                                href="/">いいねしたユーザー</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</x-app-layout>
