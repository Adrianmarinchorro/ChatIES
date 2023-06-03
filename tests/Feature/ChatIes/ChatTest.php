<?php

namespace Tests\Feature\ChatIes;

use App\Models\Chat;
use Tests\TestCase;
use App\Models\History;
use Inertia\Testing\AssertableInertia as Assert;
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
        $chat = Chat::factory()->create([
            'history_id' => $history->id
        ]);

        // problema has
        /*$this->get('/chat')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Chat')
                ->has('chats', fn (Assert $page) => $page
                    ->where('id', $chat->id)
                    ->where('data', $message)
                )
            );*/

        $this->get('/chat')
            ->assertInertia(fn (Assert $page) => $page
                ->where('chats.id', $chat->id)
                ->where('chats.data', json_decode($chat->data, true))
            );
    }
}
