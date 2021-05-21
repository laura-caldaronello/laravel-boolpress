<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

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
    public function create(Category $categories)
    {
        $data = [
            'categories' => Category::all()
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
        
        $new_post->save();
        
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'post' => $post
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

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
