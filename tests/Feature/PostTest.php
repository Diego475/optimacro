<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    public $posts;
    public $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->posts = Post::factory()->count(6)->create();
        $this->user = User::factory()->create();
    }

    public function tearDown() : void
    {
        Post::whereIn('id', $this->posts->map->only(['id']))->forceDelete();
        $this->user->forceDelete();
        parent::tearDown();
    }

    public function test_get_posts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_get_post()
    {   
        $response = $this->get('/api/posts/' . $this->posts[0]->id);
        $response->assertStatus(200);
    }

    public function test_delete_post()
    {
        $response = $this->actingAs($this->user, 'api')->delete('/api/posts/' . $this->posts[0]->id);
        $response->assertStatus(200);
    }

    public function test_create_post()
    {
        $post = $this->posts[0];
        $response = $this->actingAs($this->user, 'api')->post('/api/posts', [
            "id" => $post->id,
            "title" => $post->title,
            "short_description" => $post->short_description,
            "description" => $post->description
        ]);
        $response->assertStatus(200);
    }
}
