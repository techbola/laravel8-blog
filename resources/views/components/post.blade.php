<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">
        {{ $post->user->username }}
    </a>
    <span class="text-gray-600 text-sm">
        {{ $post->created_at->diffForHumans() }}
    </span>

    <p class="mb-2">
        {{ $post->body }}
        <br>
        <a href="{{ route('posts.show', $post) }}" class="font-bold text-blue-400 underline">
            read
        </a>
    </p>

    {{--                        @if($post->ownedBy(auth()->user()))--}}
    {{--                            <div>--}}
    {{--                                <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">--}}
    {{--                                    @csrf--}}
    {{--                                    @method('DELETE')--}}
    {{--                                    <button type="submit" class="text-red-500">Delete</button>--}}
    {{--                                </form>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button>
        </form>
    @endcan

    @auth
        <div class="flex items-center">
            @if(!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @endif
            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Unlike</button>
            </form>

            <span>
                {{ $post->likes->count() }}
                {{ Str::plural('like', $post->likes->count()) }}
            </span>
        </div>
    @endauth
</div>
