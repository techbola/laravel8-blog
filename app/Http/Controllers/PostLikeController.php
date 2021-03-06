<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        if (!$post->likes()->onlyTrashed()->where('user_id', auth()->id())->count()) {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post)
    {
        auth()->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
