<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function tearDown() : void
    {
        User::where('id', $this->user->id)->forceDelete();
        parent::tearDown();
    }

    public function test_login()
    {
        $response = $this->post('api/login', [
            "email" => $this->user->email,
            "password" => 'qwerty123'
        ]);

        $response->assertStatus(200);
    }
}
