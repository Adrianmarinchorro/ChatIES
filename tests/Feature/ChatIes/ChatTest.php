<?php

namespace Tests\Feature\ChatIes;

use App\Models\Chat;
use App\Models\User;
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

        $this->get('/chat')
            ->assertInertia(fn (Assert $page) => $page
                ->where('chats.id', $chat->id)
                ->where('chats.data', json_decode($chat->data, true))
            );
    }

    public function test_user_can_chat_with_the_ai(): void
    {
        $this->signIn();

        $response = $this->post('/chat', [
           'message' => 'Hola que tal?'
        ]);

        $user = User::first();
        $history = $user->history;
        $chats = $history->chats;

        $response->assertInertia(fn (Assert $page) => $page
            ->where('chats.id', $chats[0]->id)
            ->where('chats.data', json_decode($chats[0]->data, true)));
    }

    public function test_user_can_create_a_new_chat(): void
    {
        $this->signIn();

        $response1 = $this->post('/chat', [
            'message' => 'Hola que tal?'
        ]);

        $user = User::first();
        $history = $user->history;
        $chats = $history->chats;

        $response1->assertInertia(fn (Assert $page) => $page
            ->where('chats.id', $chats[0]->id)
            ->where('chats.data', json_decode($chats[0]->data, true)));

        $this->get('/newChat')->assertStatus(302)->assertRedirect('/chat');

        $response2 = $this->post('/chat', ["message" => 'porque?'])->assertStatus(200);

        $chats2 = $history->chats;

        dd(History::first()->chats);

        $response2->assertInertia(fn (Assert $page) => $page
            ->whereNot('chats.id', $chats2[0]->id)
            ->whereNot('chats.data', json_decode($chats2[0]->data, true))
            >where('chats.id', $chats2[1]->id)
        );

    }
}
