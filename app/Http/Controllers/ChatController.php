<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;


class ChatController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $history =  $user->history;
        $chat = Chat::where('history_id', $history->id)->latest()->first();
        $chat->data = json_decode($chat->data);

        return Inertia::render('Chat', [
            "history" => $history,
            "chat" => $chat
        ]);
    }

    public function addChat(Request $request)
    {
        if(!$request->isMethod('POST')){
            return redirect(route('chat'));
        }

//        $result = OpenAI::completions()->create([
//            'model' => 'text-curie-001',
//            'prompt' => $request['search'],
//        ]);


        $user = auth()->user();
        $history = null;
        $chat = null;

        if(!$user->history){

           $history =  $user->history()->create();

           $data = json_encode([
            0 => [
                'request' => $request['message'],
                'response' => Str::random(10),
            ]
           ]);

           $chat =  $history->chats()->create([
            'data' => $data
           ]);


        }else {

            $history =  $user->history;
            $chat = $history->chats()->find(1);
            $data = json_decode($chat->data);

            $data[] = [
                'request' => $request['message'],
                'response' => Str::random(10),
            ];

            $chat->data = json_encode($data);

            $chat->save();
        }

        $chat->data = json_decode($chat->data);

        return Inertia::render('Chat', [
            "history" => $history,
            "chat" => $chat
        ]);
    }
}
