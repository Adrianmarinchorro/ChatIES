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

        $this->actingAs($user)->get('/newChat')->assertStatus(302)->assertRedirect('/chat');

        $chats2 = History::first()->chats;

        $response2 = $this->actingAs($user)->post('/chat', [
            'chats_id' => $chats2[1]->id,
            'message' => 'Por que'
        ]);

        $response2->assertInertia(fn (Assert $page) => $page
            ->whereNot('chats.id', $chats2[0]->id)
            ->where('chats.id', $chats2[1]->id)
        );

    }

    //TODO: pendiente revision guiño guiño, orden ya tu sabe.
    public function test_user_can_change_the_chat_view(): void
    {
        $this->signIn();

        $user = User::first();
        $history = History::factory()->create(['user_id' => $user->id]);

        $chat1 = Chat::factory()->create(['history_id' => $history->id]);
        $chat2 = Chat::factory()->create(['history_id' => $history->id]);

        $response = $this->actingAs($user)->get('/chat?id=' . $chat1->id);

        $response->assertInertia(fn (Assert $page) => $page
            ->where('chats.id', $chat1->id)
            ->whereNot('chats.id', $chat2->id)
        );

        $response = $this->actingAs($user)->get('/chat?id=' . $chat2->id );

        $response->assertInertia(fn (Assert $page) => $page
            ->where('chats.id', $chat2->id)
            ->whereNot('chats.id', $chat1->id)
        );
    }

    public function test_user_can_delete_a_chat(): void
    {
        $this->signIn();

        $user = User::first();
        $history = History::factory()->create(['user_id' => $user->id]);

        $chat1 = Chat::factory()->create(['history_id' => $history->id]);
        $chat2 = Chat::factory()->create(['history_id' => $history->id]);
        $chat3 = Chat::factory()->create(['history_id' => $history->id]);

        $allChats = Chat::where('history_id', $history->id)->get();

        $this->actingAs($user)->delete('/deleteChat/' . $chat2->id);

        $response = $this->get('/chat');

        $response->assertInertia(fn (Assert $page) => $page
            ->where('allChats.0.id', $allChats[0]->id)
            ->whereNot('allChats.1.id', $allChats[1]->id)
            ->where('allChats.1.id', $allChats[2]->id)
        );
    }

    public function test_user_can_delete_history(): void
    {
        $this->signIn();

        $user = User::first();
        $history = History::factory()->create(['user_id' => $user->id]);

        Chat::factory()->create(['history_id' => $history->id]);
        Chat::factory()->create(['history_id' => $history->id]);
        Chat::factory()->create(['history_id' => $history->id]);

        $this->actingAs($user)->delete('/deletehistory');

        $this->assertDatabaseMissing('histories', ['id' => $history->id]);
        $this->assertDatabaseEmpty('chats');
    }
}
