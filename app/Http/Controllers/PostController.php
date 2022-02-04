<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact(['posts']));
    }

    public function create()
    {
        //
    }

    public function store(PostRequest $request)
    {
        $post = $this->post->create($request->validated());

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

    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);

        return redirect("/posts/{$post->id}");
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect("/posts");
    }
}
