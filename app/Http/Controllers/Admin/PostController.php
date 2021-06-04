<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];
        return view('admin.posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];
        return view('admin.posts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);

        $slug = Str::slug($new_post->title,'-');
        $slug_base = $slug;
        $post_presente = Post::where('slug',$slug)->first();
        $contatore = 1;
        while ($post_presente) {
            $slug = $slug_base . '-' . $contatore;
            $contatore++;
            $post_presente = Post::where('slug',$slug)->first();
        }
        $new_post->slug = $slug;
        
        $new_post->user_id = Auth::id();

        if (array_key_exists('image',$data)) {
            $image_path = Storage::put('post_images',$data['image']);
            $data['image'] = $image_path;
        }
        $new_post->image = $data['image'];

        $new_post->save();

        if (array_key_exists('tags',$data)) {
            $new_post->tags()->sync($data['tags']);
        }
        else {
            $new_post->tags()->sync([]);
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post' => $post
        ];
        return view('admin.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];
        return view('admin.posts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $slug = Str::slug($data['title'],'-');
        $slug_base = $slug;
        $post_presente = Post::where('slug',$slug)->first();
        $contatore = 1;
        while ($post_presente && ($post_presente->id != $post->id)) {
            $slug = $slug_base . '-' . $contatore;
            $contatore++;
            $post_presente = Post::where('slug',$slug)->first();
        }
        $data['slug'] = $slug;

        $post->update($data);

        if (array_key_exists('tags',$data)) {
            $post->tags()->sync($data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
