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
        $ids = $this->posts->map->only(['id']);
        Post::whereIn('id', $ids)->forceDelete();
        parent::tearDown();
    }

    public function test_example()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }
}
