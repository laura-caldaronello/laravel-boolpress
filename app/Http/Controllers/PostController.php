<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index() {
        $data = [
            'posts' => Post::all()
        ];

        return view('guest.posts.index',$data);
    }

    public function show($slug) {
        $post = Post::where('slug',$slug)->first();
        if (!$post) {
            abort(404);
        };
        $user = User::find($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        return view('guest.posts.show',$data);
    }
}
