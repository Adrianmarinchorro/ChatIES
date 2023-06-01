<?php

namespace Tests\Feature\ChatIes;

use Tests\TestCase;
use App\Models\History;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    public function test_can_see_the_chat_page(): void
    {
        $this->signIn();

        $this->get('/chat')
            ->assertStatus(200);
    }

    public function test_can_see_the_chat(): void
    {
        $this->signIn();

        $history = History::factory()->create();
        $chat = History::factory()->create([
            'history_id' => $history->id
        ]);

        
    }
}
