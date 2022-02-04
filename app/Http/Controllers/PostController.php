<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact(['posts']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::create($validated);

        return redirect("/posts/{$post->id}");
    }

    public function show(Post $post)
    {
        return view('posts.show', compact(['post']));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->update($data);

        return redirect("/posts/{$post->id}");
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect("/posts");
    }
}
