<?php

namespace Tests\Feature\ChatIes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{

    public function loggin(): void
    {
        $this->post('/login', [
            'username' => 'am',
            'password' => '123'
        ]);
    }

    public function test_can_see_the_chat_page(): void
    {
        $this->loggin();

        $this->get('/chat')
            ->assertStatus(200);
    }
}
