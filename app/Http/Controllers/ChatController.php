<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Orhanerday\OpenAi\OpenAi;


class ChatController extends Controller
{


    public function index(Request $request)
    {
        $user = auth()->user();
        $history = null;
        $chat = null;
        $allChats = null;

        $chatId = $request['id'];

        if($user->history){
            $history =  $user->history;


            if($chatId) {
                $chat = Chat::find($chatId);
            } else {
                $chat = Chat::where('history_id', $history->id)->latest()->first();
            }

            $chat->data = json_decode($chat->data);

            $allChats = $history->chats;

        }

        return Inertia::render('Chat', [
            "history" => $history,
            "chats" => $chat,
            "allChats" => $allChats
        ]);
    }

    public function addChat(Request $request)
    {
        if(!$request->isMethod('POST')){
            return redirect(route('chat'));
        }

        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $result = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "user",
                    "content" => $request["message"]
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 1000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        $result = json_decode($result);

        $user = auth()->user();
        $history = null;
        $chat = null;
        $allChats = null;

        if(!$user->history){

           $history =  $user->history()->create();

           $data = json_encode([
            0 => [
                'request' => $request['message'],
                'response' => $result->choices[0]->message->content,
            ]
           ]);

           $chat =  $history->chats()->create([
            'data' => $data
           ]);


        }else {

            $history =  $user->history;
            $chat = $history->chats()->find($request->chats_id);
            $data = json_decode($chat->data);

            $data[] = [
                'request' => $request['message'],
                'response' => $result->choices[0]->message->content,
            ];

            $chat->data = json_encode($data);

            $chat->save();
        }

        if($history && $history->chats()->count() > 1) {
            $allChats = $history->chats;
        }

        $chat->data = json_decode($chat->data);

        return Inertia::render('Chat', [
            "history" => $history,
            "chats" => $chat,
            "allChats" => $allChats
        ]);
    }


    public function newChat(){

        $user = auth()->user();
        $history = $user->history;

        if($history){
            $chat = Chat::where('history_id', $history->id)->latest()->first();

            if($chat->data != '[]'){
                auth()->user()->history->chats()->create([
                    'data' => json_encode([]),
                ]);
            }
        }
        return to_route('chat');
    }

    public function deleteChat(int $id)
    {
        $user = auth()->user();
        $history = $user->history;
        $chat = Chat::find($id);

        if($chat){
            $chat->delete();
        }

        if(count($history->chats) == 0){
            $history->delete();
        }

        return to_route('chat');
    }

}
