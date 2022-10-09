<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    public $posts;

    public function setUp() : void
    {
        parent::setUp();
        $this->posts = Post::factory()->count(6)->create();
    }

    public function tearDown() : void
    {
        Post::whereIn('id', $this->posts->map->only(['id']))->forceDelete();
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
}
