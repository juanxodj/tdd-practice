<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_of_post_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        Post::factory()->count(3)->make();

        $response = $this->get('/posts');
        $response->assertOk();

        $posts = Post::all();

        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts', $posts);
    }

    public function test_a_post_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $response = $this->get("/posts/{$post->id}");
        $response->assertOk();

        $post = Post::first();

        $response->assertViewIs('posts.show');
        $response->assertViewHas('post', $post);
    }

    public function test_a_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => 'Test Content'
        ]);

        $this->assertCount(1, Post::all());

        $post = Post::first();

        $this->assertEquals($post->title, 'TEST TITLE');
        $this->assertEquals($post->content, 'Test Content');
        $this->assertEquals($post->slug, 'test-title');

        $response->assertRedirect("/posts/{$post->id}");
    }

    public function test_post_title_is_required()
    {
        $response = $this->post('/posts', [
            'title' => '',
            'content' => 'Lorem ipsum'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_post_content_is_required()
    {
        $response = $this->post('/posts', [
            'title' => 'Lorem ipsum',
            'content' => ''
        ]);

        $response->assertSessionHasErrors(['content']);
    }

    public function test_a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        $this->assertCount(1, Post::all());

        $post = $post->fresh();

        $this->assertEquals($post->title, 'TEST TITLE');
        $this->assertEquals($post->content, 'Test Content');
        $this->assertEquals($post->slug, 'test-title');

        $response->assertRedirect("/posts/{$post->id}");
    }

    public function test_a_post_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $response = $this->delete("/posts/{$post->id}");

        $this->assertCount(0, Post::all());

        $response->assertRedirect("/posts");
    }
}
